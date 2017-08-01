<?php

Class Database {

    protected $db;
    protected $result;
    protected $num_rows;
    protected $insert_id;
    protected $affected_rows;
    protected $last_query;

    /**
     * 链接数据库
     * @param string $host 数据库地址
     * @param string $user 数据库用户
     * @param string $pass 数据库密码
     * @param string $name 数据库名称
     */
    public function __construct($host, $user, $pass, $name, $charset = 'UTF-8') {

        mysqli_report(MYSQLI_REPORT_OFF);

        $this->db = new Mysqli($host, $user, $pass, $name);

        if( $this->db->connect_errno ) {
            throw new Exception($this->db->connect_error, $this->db->connect_errno);
        }

        $this->db->set_charset($charset);
    }

    /**
     * 执行SQL查询
     * @param  string $sql SQL语句
     * @return object
     */
    public function query($sql) {

        // query
        $this->result = $this->db->query($sql);

        if( ! $this->result ) {
            throw new Exception($this->db->connect_error, $this->db->connect_errno);
        }

        // last query
        $this->last_query = $sql;

        // num rows by result (INSERT/DELETE/UPDATE 操作没有 num_rows)
        $this->num_rows = isset($this->result->num_rows) ? $this->result->num_rows : 0;

        // insert id by db
        $this->insert_id = $this->db->insert_id;

        // affected rows by db
        $this->affected_rows = $this->db->affected_rows;

        return $this;
    }

    /**
     * 返回结果集，没有结果返回 FALSE
     * @param  boolean $field 仅返回字段
     * @return array
     */
    public function result($field = FALSE) {

        $data = array();

        while($row = $this->row($field)) {
            $data[] = $row;
        }

        // 0 rows return FALSE
        return count($data) ? $data : FALSE;
    }

    /**
     * 返回一行结果
     * @param  boolean $field 仅返回字段
     * @return array
     */
    public function row($field = FALSE) {

        $row = $this->result->fetch_assoc();

        // 0 rows return FALSE
        if( NULL === $row ) {
            return FALSE;
        }

        if( FALSE !== $field ) {
            $row = isset($row[$field]) ? $row[$field] : FALSE;
        }

        return $row;
    }

    /**
     * 插入数据操作
     * @param  string $table 表名
     * @param  array  $data  插入的数据
     * @return integer
     */
    public function insert($table, $data = array()) {

        if( empty($data) ) {
            return 0;
        }

        $field = $value = $repet = $types = array();

        foreach($data AS $k=>$v) {
            $value[] = &$data[$k];
            $field[] = $k;
            $repet[] = '?';
            $types[] = is_integer($v) ? 'i' : 's';
        }

        $field = implode(',', $field);
        $repet = implode(',', $repet);

        array_unshift($value, implode('', $types));

        $stmt = $this->db->prepare("INSERT INTO {$table} ({$field}) VALUES ({$repet})");

        // failed
        if( $stmt === FALSE ) {
            return 0;
        }

        call_user_func_array(array($stmt, 'bind_param'), $value);

        $stmt->execute();

        $insertId = $stmt->insert_id;

        $stmt->close();

        return $insertId;
    }

    /**
     * 根据条件更新指定行
     * @param  string $table 要更新的表名
     * @param  array  $where 更新条件，值为数字时自动更新主键
     * @param  array  $data  要更新的数据
     * @return integer
     */
    public function update($table, $data, $where = array()) {

        // 没有条件时不更新，以免全表被更新
        if( ! $where ) {
            return 0;
        }

        if( ! is_array($where) ) {
            $key = $this->primaryKey($table);
            $where = array($key => $where);
        }

        $value = $datas = $types = $terms = array();

        foreach($data AS $k=>$v) {
            $value[]    = &$data[$k];
            $datas[$k]  = '?';
            $types[]    = is_integer($v) ? 'i' : 's';
        }

        foreach($where AS $k=>$v) {
            $value[]    = &$where[$k];
            $terms[$k]  = '?';
            $types[]    = is_integer($v) ? 'i' : 's';
        }

        array_unshift($value, implode('', $types));

        $terms = $this->queryString($terms, 'AND');
        $datas = $this->queryString($datas);

        $stmt = $this->db->prepare("UPDATE {$table} SET {$datas} WHERE {$terms}");

        // failed
        if( $stmt === FALSE ) {
            return 0;
        }

        call_user_func_array(array($stmt, 'bind_param'), $value);

        $stmt->execute();

        $affectedRows = $stmt->affected_rows;

        $stmt->close();

        return $affectedRows;
    }

    /**
     * 根据条件删除指定行
     * @param  string $table 要删除的表名
     * @param  array  $where 删除条件，值为数字时自动指定主键
     * @return integer
     */
    public function delete($table, $where) {

        // 没有条件时不更新，以免全表被删除
        if( ! $where ) {
            return 0;
        }

        if( ! is_array($where) ) {
            $key = $this->primaryKey($table);
            $where = array($key => $where);
        }

        $where = $this->queryString($where, 'AND');

        $this->query("DELETE FROM {$table} WHERE {$where}");

        return $this->affected_rows;
    }

    /**
     * 返回主键名称
     * @param  string $table 表名称
     * @return string
     */
    public function primaryKey($table) {
        return $this->query("SHOW KEYS FROM `{$table}` WHERE Key_name='PRIMARY'")->row('Column_name');
    }

    /**
     * 将键值对数组转成查询字符
     * @param  array $array 键值对
     * @return string
     */
    public function queryString($array, $delimiter = ',') {

        if( ! is_array($array) ) {
            return '';
        }

        $data = array();
        foreach($array AS $k=>$v) {
            if( is_int($k) ) {
                $data[] = "`{$v}`";
            } else {
                $value  = (is_int($v) OR ($v === '?')) ? $v : sprintf('"%s"', $v);
                $data[] = "`{$k}` = {$value}";
            }
        }

        return implode($data, sprintf(' %s ', trim($delimiter)));
    }

    public function affected_rows()
    {
        return $this->affected_rows;
    }

    public function num_rows()
    {
        return $this->num_rows;
    }

    public function last_query()
    {
        return $this->last_query;
    }

    /**
     * 复制、序列、反序列等操作
     * @return void
     */
    public function __clone() { }
    public function __sleep() { }
    public function __wakeup() { }

}

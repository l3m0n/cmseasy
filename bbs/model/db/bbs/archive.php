<?php

class db_bbs_archive extends db_base {

    static function getInstance() {
        return parent::getInstance(__CLASS__);
    }

    protected function __construct($tblName = __CLASS__) {
        parent::__construct($tblName);
    }

    function updateClickReply($aid, $field) {
    	$aid = intval($aid);
        $sql = "UPDATE {$this->tblName} SET {$field}={$field}+1 WHERE `aid`={$aid}";
        $r = $this->odb->execSql($sql);
        if (!$r)
            action_public::turnPage('index.php', '更新文章点击数出错，请联系我们！');
    }

    function getArchive($field, $cid, $limit) {
        $page = isset($_GET['page']) ? intval($_GET['page']) : 1;
        $total_num = $this->odb->getRowsCount($this->tblName, "cid=" . $cid);
        $tota_page = ceil($total_num / $limit);
        if ($page < 1)
            $page = 1;
        if ($page > $tota_page)
            $page = $tota_page;

        $start = ($page - 1) * $limit;
        $sql = "SELECT {$field} FROM {$this->tblName} WHERE cid='{$cid}' and isstop='0' order by aid desc limit {$start},$limit";
        $data = $this->odb->getRows($sql);

        $link_str = action_public::listPage($tota_page, $limit, $page);
        return array($data, $link_str);
    }

    function getDataBySelect($arr) {
        $where = "isstop='" . intval($arr['isstop']) . "'";
        if ($arr['cid'] != 0)
            $where .= "AND cid='" . intval($arr['cid']) . "'";
        if (!empty($arr['start_time']))
            $where .= "AND addtime>='" . strtotime($arr['start_time']) . "'";
        if (!empty($arr['end_time']))
            $where .= "AND addtime<='" . strtotime($arr['end_time']) . "'";
        $sql = "SELECT * FROM {$this->tblName} WHERE {$where}";
        return $this->odb->getRows($sql);
    }

    function updateStop($aid) {
        $sql = "UPDATE {$this->tblName} SET isstop=1-isstop WHERE aid='{$aid}';";
        $r = $this->odb->execSql($sql);
        if (!$r)
            action_public::turnPageAdmin('index.php', '更新帖子状态出错，请联系我们！！');
    }

}

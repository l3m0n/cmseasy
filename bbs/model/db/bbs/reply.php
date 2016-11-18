<?php

class db_bbs_reply extends db_base {

    static function getInstance() {
        return parent::getInstance(__CLASS__);
    }

    protected function __construct($tblName = __CLASS__) {
        parent::__construct($tblName);
    }

    public function getReply($field, $aid, $limit=10) {
        $page = isset($_GET['page']) ? intval($_GET['page']) : 1;
        $total_num = $this->odb->getRowsCount($this->tblName, "tid='0' AND aid = '{$aid}'");
        $tota_page = ceil($total_num / $limit);
        if ($page < 1)
            $page = 1;
        if ($page > $tota_page)
            $page = $tota_page;

        $start = ($page - 1) * $limit;
        $sql = "select {$field} from {$this->tblName} where tid in (SELECT id from (SELECT id FROM {$this->tblName} WHERE tid = '0' AND aid = '{$aid}' limit {$start},{$limit} ) as temp)union all(SELECT {$field} FROM {$this->tblName} WHERE tid = '0' AND aid = '{$aid}' limit {$start},{$limit}) order by id asc";
        $temp = $this->odb->getRows($sql);
        $result = array();
        if (!empty($temp)) {
            foreach ($temp as $v) {
                if ($v['tid'] == 0) {
                    $result[$v['id']][] = $v;
                } else {
                    $result[$v['tid']][] = $v;
                }
            }
        }
        $link_str = action_public::listPage($tota_page, $limit, $page);
        return array($result, $link_str);
    }

}

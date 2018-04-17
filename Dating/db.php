<?php

define('HOSTNAME', 'localhost');
define('DATABASE', 'dating_loc');
define('USERNAME', 'mysql');
define('PASSWORD', 'mysql');

class Db {

    public function __construct() {
        try {
            $this->db = new PDO ('mysql:host=' . HOSTNAME . ';dbname=' . DATABASE, USERNAME, PASSWORD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            exit ($e->getMessage());
        }
    }

//parse_profiles. вставка профиля
    public function profile_insert($profile) {
        $insert = $this->db
            ->prepare("INSERT IGNORE INTO `profiles` (`url`, `sex`) VALUES (:url, :sex)");
        $insert->execute(array(
            'url' => $profile['url'],
            'sex' => $profile['sex'],
        ));
        return $this->db->lastInsertId();
    }

//send_message. //TODO меняем правила в зависимости от того кому постим
    public function profile_get($id, $sex) {
        $sql = "
SELECT `profiles`.`id`, `profiles`.`url` 
FROM `profiles`
WHERE
`sex` = '" . $sex . "'
AND

NOT EXISTS (
  SELECT * 
  FROM `accounts_has_profiles`
  WHERE
  -- когда оба правила, то мы с челом постим с пересечением профилей, на одни и теже.
  `accounts_id` = " . $id . " 
  AND 
  -- если только это нижнее, то без пересечения.
  `profiles_id` = `profiles`.`id`
)

ORDER BY RAND() 
LIMIT 1";
        return $this->db->query($sql)->fetch();
    }

    public function profile_del($id) {
        $delete = $this->db->prepare("DELETE FROM `profiles` WHERE `id` = :id");
        $delete->execute(array(
            'id' => $id,
        ));
    }

    public function accounts_has_profiles_update($profile_id, $account_id) {
        $insert = $this->db->prepare("INSERT IGNORE INTO `accounts_has_profiles` (`profiles_id`, `accounts_id`) VALUES (:profiles_id, :accounts_id)");
        $insert->execute(array(
            'profiles_id' => $profile_id,
            'accounts_id' => $account_id,
        ));
        return $this->db->lastInsertId();
    }

//TODO колв-во мессаг за раз
    public function account_get($sex) {
        $sql = "SELECT * FROM `accounts` WHERE `onoff` = '1' AND `countmessages` < 100 AND `sex` = '" . $sex . "' ORDER BY RAND() LIMIT 1";
        return $this->db->query($sql)->fetch();
    }

    public function account_update($id) {
        $update = $this->db->prepare("UPDATE `accounts` SET `countmessages` = `countmessages` + 1 WHERE `id` = :id;");
        $update->execute(array(
            'id' => $id,
        ));
    }

}
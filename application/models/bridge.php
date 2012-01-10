<?php 

if (! defined('BASEPATH')) exit('No direct script access');

class Bridge extends MY_Model 
{
    protected $_name = "in_bridge";
    protected $_primary = "id";
    
    /**
     * adott hirhez kerdezi le a hozza tartozo jatekokat, platformokat
     *
     * @param string $rumorId 
     * @param string $type ha hamis akkor jatekot es platformot is visszaad
     * @param string $onlyIds ha igaz akkor csak a $type-nak megfelelo id-ket adja vissza
     * @return array
     * @author Dobi Attila
     */
    public function fetchForRumor($rumorId, $type = false, $onlyIds = false)
    {
        if (!$rumorId) {
            
            return false;
        }
        
        $sql = "select b.*, g.name as game, p.name as platform from $this->_name as b join in_game as g on b.game_id = g.id join in_platform p on b.platform_id = p.id where b.rumor_id = $rumorId";
        
        $result = $this->execute($sql);
        
        if (!$result) return false;
        
        if (!$type) return $result;
        
        $return = array();
        foreach ($result as $item) {
            $prop = $type.'_id';
            $return[] = $item->$prop;
        }
        
        return array_unique($return);
    }
}
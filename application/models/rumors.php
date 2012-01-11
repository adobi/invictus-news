<?php 

if (! defined('BASEPATH')) exit('No direct script access');

class Rumors extends MY_Model 
{
    protected $_name = "in_rumor";
    protected $_primary = "id";
    
    public function fetchForUser($userId, $filters = array(), $page = false) 
    {
        if (!$userId) return false;
        
        $this->load->model('Users', 'user');
        
        $user = $this->user->find($userId);
        
        $perPage = ITEMS_PER_PAGE;
        
        if (!$page) $page = 0;
                
        if (!$user) return false;
        
        if ($user->role === '1') {
            
            if (empty($filters)) {
                /*
                return $this->execute("select 
                                        r.* 
                                        , (select group_concat(concat_ws(' - ', g.name, p.name), ' ') from in_bridge b join in_platform p on b.platform_id = p.id join in_game g on b.game_id = g.id where b.rumor_id = r.id) gp
                                      from in_rumor r order by created desc");
                */
                
                $sql = "select distinct r.*
                                , (select group_concat(distinct(g.name), ' ') from in_bridge b join in_game g on b.game_id = g.id where b.rumor_id = r.id) as games
                                , (select group_concat(distinct(p.name), ' ') from in_bridge b join in_platform p on b.platform_id = p.id where b.rumor_id = r.id) as platforms
                            from in_rumor r order by created desc limit $perPage offset $page
                        ";
                
                $result = $this->execute($sql);
                $return['result'] = $result;
                $return['count'] = @current($this->execute('select count(id) as total from in_rumor'))->total;
                
                return $return;
            }
            
            $games = false;
            if (isset($filters['games'])) {
                $games = join(', ', $filters['games']);
            }
            
            $platforms = false;
            if (isset($filters['platforms'])) {
                $platforms = join(', ', $filters['platforms']);
            }
            
            if ($games || $platforms) {
                
                
                $sql = "select distinct r.*
                            , (select group_concat(distinct(g.name), ' ') from in_bridge b join in_game g on b.game_id = g.id where b.rumor_id = r.id) as games
                            , (select group_concat(distinct(p.name), ' ') from in_bridge b join in_platform p on b.platform_id = p.id where b.rumor_id = r.id) as platforms
                            from in_rumor r where id in ( select rumor_id from in_bridge";
                $sqlTotal = "select count(distinct r.id) as total from in_rumor r where id in ( select rumor_id from in_bridge";
                if ($games && $platforms) {
                    
                    $s = " where game_id in ($games) and platform_id in ($platforms)";
                    $sql .= $s;
                    $sqlTotal .= $s;
                } else {
                    
                    if ($games) {
                        $s = " where game_id in ($games)";
                        $sql .= $s;
                        $sqlTotal .= $s;
                    }
                        
                    if ($platforms) {
                        $s = " where platform_id in ($platforms)";
                        $sql .= $s;
                        $sqlTotal .= $s;
                    }
                }
                    
                $sql .= " )  limit $perPage offset $page";
                $sqlTotal .= ")";
                
                $result = $this->execute($sql);
                $return['result'] = $result;
                $return['count'] = @current($this->execute($sqlTotal))->total;
                
                return $return;
            }
            
            return false;
            
        } else {
            
            $sql = "select  distinct r.*
                        , (select group_concat(distinct(g.name), ' ') from in_bridge b join in_game g on b.game_id = g.id where b.rumor_id = r.id and  b.game_id in (select game_id from in_user_game where user_id = $userId)) as games
                        , (select group_concat(distinct(p.name), ' ') from in_bridge b join in_platform p on b.platform_id = p.id where b.rumor_id = r.id and  b.game_id in (select game_id from in_user_game where user_id = $userId)) as platforms
                        from in_rumor r join in_bridge b on r.id = b.rumor_id and b.game_id in (select game_id from in_user_game where user_id = $userId)  limit $perPage offset $page";
            $result = $this->execute($sql);
            $return['result'] = $result;
            $return['count'] = @current($this->execute("select count(distinct r.id) as total from in_rumor r join in_bridge b on r.id = b.rumor_id where b.game_id in (select game_id from in_user_game where user_id = $userId)"))->total;
            //dump($return); die;
            return $return;            
        }
        
        return false;
    }
}
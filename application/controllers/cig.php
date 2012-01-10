<?php  

class Cig extends CI_Controller 
{
    private $_controllerBundle;
    private $_modelBundle;
    private $_table;
    private $_originalTable;
    private $_prefix;
    private $_tabe_without_prefix;
    
    public function __construct() 
    {
        $this->_controllerBundle = APPPATH . 'cig/controller.php';
        
        $this->_modelBundle = APPPATH . 'cig/model.php';
        
        $this->_bundleDir = APPPATH . 'cig/';
        
        parent::__construct();
    }
    
    public function index()
    {
        $this->form_validation->set_rules('table_name', 'Table name', 'trim|required');
        
        if ($this->form_validation->run()) {
            
            $this->_table = strtolower(str_replace('_', '', $_POST['table_name']));
            
            $this->_preifx = $_POST['prefix'];
            $this->_tabe_without_prefix = $_POST['table_name'];
            
            $this->_originalTable = $_POST['prefix'] . '_' . $_POST['table_name'];
            //$result = $this->db->query('show columns from ' . $table)->result();
            
            //dump($result); 
            
            $this->_generateModel()->_generateController()->_generateView();
            
            //dump(preg_match('/(varchar|int)/', 'datetime'));
            //die;
            
            //die;
        }
        
        $this->template->build('cig/index');
    }
    
    private function _generateController()
    {
        $table = $this->_table;
        
        $controllerDefinition = file_get_contents($this->_controllerBundle);
        
        $controllerClassName = ucfirst($table);
        $modelClassName = $controllerClassName . 's';
        $viewDir = $table;
        
        $result = $this->db->query('show columns from ' . $this->_originalTable)->result();
        
        $form_validations = '';
        if ($result) {
            foreach ($result as $item) {
                if ($item->Field !== 'id') {
                    $form_validations .= '$this->form_validation->set_rules("'.$item->Field.'", "'.ucfirst($item->Field).'", "trim|required");'."\r\n\t\t";
                }
            }
        }
        
        
        $tmpls = array('%%CONTROLLER_CLASS_NAME%%', '%%MODEL_NAME%%', '%%VIEW_DIR_NAME%%', '%%FORM_VALIDATION_RULES%%');
        $vals = array($controllerClassName, $modelClassName, $viewDir, $form_validations);
        
        //dump($vals);
        
        $controllerDefinition = str_replace($tmpls, $vals, $controllerDefinition);
        
        file_put_contents(APPPATH.'controllers/'.$table.'.php', $controllerDefinition);
        
        //dump($controllerDefinition);
        
        return $this;
    }
    
    private function _generateModel() 
    {
        $table = $this->_originalTable;
        
        $modelDefinition = file_get_contents($this->_modelBundle);
        
        $model = ucfirst($this->_table . 's');
        
        $modelDefinition = str_replace(array('%%MODEL_CLASS_NAME%%', "%%TABLE_NAME%%"), array($model, $table), $modelDefinition);
        
        file_put_contents(APPPATH.'models/'.strtolower($model) . '.php', $modelDefinition);
        
        return $this;
    }
    
    private function _generateView()
    {
        $table = $this->_table;
        $controller = $this->_tabe_without_prefix;
        
        $viewDir = APPPATH . 'views/' . $table;
        @mkdir($viewDir);
        //$this->_buildViewForTable($table);
        
        $index = str_replace(array('%%CONTROLLER%%'), array($controller), file_get_contents($this->_bundleDir . 'index.php'));
        
        file_put_contents($viewDir . '/index.php', $index);
        file_put_contents($viewDir . '/edit.php', $this->_buildViewForTable($table));
        
        return $this;
    }
    
    private function _buildViewForTable($table)
    {
        $edit = file_get_contents($this->_bundleDir . 'edit_open.php');
        
        $result = $this->db->query('show columns from ' . $this->_originalTable)->result();
        
        if (!$result) {
            
            return '';
        }
        
        foreach ($result as $col) {
            
            if ($col->Field !== 'id') {
                
                if (preg_match('/(varchar|int)/', $col->Type)) {
                    $edit .= str_replace(
                                array('%%COLUMN_NAME%%', '%%UC_COLUMN_NAME%%'), 
                                array($col->Field, ucfirst($col->Field)), 
                                file_get_contents($this->_bundleDir . 'edit_inputtext.php')
                            );
                    //dump($col->Field . ' - ' . $col->Type, 'input text');
                }
                
                if (preg_match('/text/', $col->Type)) {
                    $edit .= str_replace(
                                array('%%COLUMN_NAME%%', '%%UC_COLUMN_NAME%%'), 
                                array($col->Field, ucfirst($col->Field)), 
                                file_get_contents($this->_bundleDir . 'edit_textarea.php')
                            );
                    //dump($col->Field . ' - ' . $col->Type, 'textarea');
                }
                
                if (preg_match('/datetime/', $col->Type)) {
                    $edit .= str_replace(
                                array('%%COLUMN_NAME%%', '%%UC_COLUMN_NAME%%'), 
                                array($col->Field, ucfirst($col->Field)), 
                                file_get_contents($this->_bundleDir . 'edit_inputdate.php')
                            );
                    //dump($col->Field . ' - ' . $col->Type, 'datetime');
                }                
            }
        } 
        
        $edit .= file_get_contents($this->_bundleDir . 'edit_close.php');
        
        return $edit;
    }
}
<?php
/**
 * Content Plugin for Joomla! - Chapter 04 / Test 02
 *
 * @author Jisse Reitsma (jisse@yireo.com)
 * @copyright Copyright 2014 Jisse Reitsma
 * @license GNU Public License version 3 or later
 * @link http://www.yireo.com/books/
 */

defined('JPATH_BASE') or die();

jimport('joomla.form.formfield');
class JFormFieldTestselect2 extends JFormField
{
    public $type = 'Test select 2';

    protected function getInput() 
    {   
        $db = JFactory::getDbo(); 
        $query = $db->getQuery(true); 
        $query->select(array('w.url', 'w.title')); 
        $query->from('#__weblinks AS w'); 
        $query->where('w.approved = 1'); 
        $query->order('w.title'); 
        $db->setQuery($query); 
            
        $options = array();
        $rows = $db->loadObjectList(); 
        if (!empty($rows))
        { 
            foreach ($rows as $row)
            { 
                $options[] = JHTML::_('select.option', $row->url, $row->title, 'value', 'text'); 
            }   
        }   


        $multiple = 0;
        if (isset($this->element['multiple'])
        {
            $multiple = (bool)$this->element['multiple'];
        }

        $size = 3;
        if (isset($this->element['size']))
        {
            $size = (int)$this->element['size'];
        }
        if ($size < 3) $size = 3;
            
        $attribs = 'class="inputbox"';
        if ($multiple == true) $attribs .= ' multiple="multiple"';
        if ($size > 0) $attribs .= ' size="'.$size.'"';

        return JHTML::_('select.genericlist', $options, $this->name, $attribs, 'value', 'text', $this->value, $this->name);
    }
}
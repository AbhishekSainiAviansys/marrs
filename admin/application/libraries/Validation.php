<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
$CI =& get_instance();
$CI->load->library('form_validation');

class Validation extends CI_Form_validation
{

	protected $_data = array();

	public function set_data($data)
	{
		if(is_array($data))
		{
			$this->_data = $data;			
		}

		return $this;
	}

	public function set_rules($field, $label = '', $rules = '')
	{
		if (count($this->_data) == 0)
		{
			return $this;
		}

		if (is_array($field))
		{
			foreach ($field as $row)
			{
				if ( ! isset($row['field']) OR ! isset($row['rules']))
				{
					continue;
				}

				$label = ( ! isset($row['label'])) ? $row['field'] : $row['label'];

				$this->set_rules($row['field'], $label, $row['rules']);
			}
			return $this;
		}

		if ( ! is_string($field) OR  ! is_string($rules) OR $field == '')
		{
			return $this;
		}

		$label = ($label == '') ? $field : $label;

		if (strpos($field, '[') !== FALSE AND preg_match_all('/\[(.*?)\]/', $field, $matches))
		{

			$x = explode('[', $field);
			$indexes[] = current($x);

			for ($i = 0; $i < count($matches['0']); $i++)
			{
				if ($matches['1'][$i] != '')
				{
					$indexes[] = $matches['1'][$i];
				}
			}

			$is_array = TRUE;
		}
		else
		{
			$indexes	= array();
			$is_array	= FALSE;
		}

		$this->_field_data[$field] = array(
			'field'				=> $field,
			'label'				=> $label,
			'rules'				=> $rules,
			'is_array'			=> $is_array,
			'keys'				=> $indexes,
			'postdata'			=> NULL,
			'error'				=> ''
		);

		return $this;
	}

	public function run($group = '')
	{
		if (count($this->_data) == 0)
		{
			return FALSE;
		}

		if (count($this->_field_data) == 0)
		{
			if (count($this->_config_rules) == 0)
			{
				return FALSE;
			}

			$uri = ($group == '') ? trim($this->CI->uri->ruri_string(), '/') : $group;

			if ($uri != '' AND isset($this->_config_rules[$uri]))
			{
				$this->set_rules($this->_config_rules[$uri]);
			}
			else
			{
				$this->set_rules($this->_config_rules);
			}

			if (count($this->_field_data) == 0)
			{
				log_message('debug', "Unable to find validation rules");
				return FALSE;
			}
		}

		$this->CI->lang->load('form_validation');

		foreach ($this->_field_data as $field => $row)
		{
			if ($row['is_array'] == TRUE)
			{
				$this->_field_data[$field]['postdata'] = $this->_reduce_array($this->_data, $row['keys']);
			}
			else
			{
				if (isset($this->_data[$field]) AND $this->_data[$field] != "")
				{
					$this->_field_data[$field]['postdata'] = $this->_data[$field];
				}
			}

			$this->_execute($row, explode('|', $row['rules']), $this->_field_data[$field]['postdata']);
		}

		$total_errors = count($this->_error_array);

		if ($total_errors > 0)
		{
			$this->_safe_form_data = TRUE;
		}

		$this->_reset_post_array();

		if ($total_errors == 0)
		{
			return TRUE;
		}

		return FALSE;
	}

	public function show_errors()
	{
		return $this->_error_array;
	}
	
	public function show_error($variable,$message,$class='error'){
		$validate=$this->_error_array;
		if(isset($validate[$variable])){
			echo "<span class='".$class."'>".$message."</span>";
		}
		
	}

	public function matches($str, $field)
	{
		if ( ! isset($this->_data[$field]))
		{
			return FALSE;
		}

		$field = $this->_data[$field];

		return ($str !== $field) ? FALSE : TRUE;
	}
	
	/*
	The rule can be used in many different ways. 'password_check[1,1,1]' would require a password contain a lowercase, uppercase, and number character. 'password_check[5,0,1]' would require 5 uppercase characters and a number in the password.
	*/
	public function password_check($str, $format)
    {
        $ret = TRUE;

        list($uppercase, $lowercase, $number) = explode(',', $format);

        $str_uc = $this->count_uppercase($str);
        $str_lc = $this->count_lowercase($str);
        $str_num = $this->count_numbers($str);

        if ($str_uc < $uppercase) // lacking uppercase characters
        {
            $ret = FALSE;
            $this->set_message('password_check', 'Password must contain at least ' . $uppercase . ' uppercase characters.');
        }
        elseif ($str_lc < $lowercase) // lacking lowercase characters
        {
            $ret = FALSE;
            $this->set_message('password_check', 'Password must contain at least ' . $lowercase . ' lowercase characters.');
        }
        elseif ($str_num < $number) //  lacking numbers
        {
            $ret = FALSE;
            $this->set_message('password_check', 'Password must contain at least ' . $number . ' numbers characters.');
        }

        return $ret;
    }

    /**
     * count the number of times an expression appears in a string
     *
     * @access private
     *
     * @param String $str
     * @param String $exp
     *
     * @return int
     */
    private function count_occurrences($str, $exp)
    {
        $match = array();
        preg_match_all($exp, $str, $match);

        return count($match[0]);
    }

    /**
     * count the number of lowercase characters in a string
     *
     * @access private
     *
     * @param String $str
     *
     * @return int
     */
    private function count_lowercase($str)
    {
        return $this->count_occurrences($str, '/[a-z]/');
    }

    /**
     * count the number of uppercase characters in a string
     *
     * @access private
     *
     * @param String $str
     *
     * @return int
     */
    private function count_uppercase($str)
    {
        return $this->count_occurrences($str, '/[A-Z]/');
    }

    /**
     * count the number of numbers characters in a string
     *
     * @access private
     *
     * @param String $str
     *
     * @return int
     */
    private function count_numbers($str)
    {
        return $this->count_occurrences($str, '/[0-9]/');
    }

	public function alpha_space($str)
	{
		return ( ! preg_match('/^([a-zA-Z ])+$/i', $str)) ? FALSE : TRUE;
	}

}
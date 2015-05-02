<?php
/**
 * @package shwang
 * @author Nik Sudan
 */

class Model
{
	public $table;
	private $columns = '*';
	private $where = null;

	/**
	 * Set the columns to select
	 * @since 1.0
	 * 
	 * @param string/array $columns
	 * @return this
	 */
	public function select( $columns )
	{
		$this->columns = $columns;
		return $this;
	}

	/**
	 * Set the where condition
	 * @since 1.0
	 * 
	 * @param array $where Medoo 'where' array (http://medoo.in/api/where)
	 * @return this
	 */
	public function where( $where )
	{
		$this->where = $where;
		return $this;
	}

	/**
	 * Fetch all rows
	 * @since 1.0
	 * 
	 * @param boolean $outputQuery
	 * @return array
	 */
	public function get( $outputQuery = false )
	{
		global $db;
		if ( $this->where == null ) {
			if ( $outputQuery ) {
				echo '<pre>$db->select( ' . print_r($this->table, true) . ', ' . print_r($this->columns, true) . ' );</pre>';
			}
			$result = $db->select( $this->table, $this->columns );
		} else {
			if ( $outputQuery ) {
				echo '<pre>$db->select( ' . print_r($this->table, true) . ', ' . print_r($this->columns, true) . ', ' . print_r($this->where, true) . ' );</pre>';
			}
			$result = $db->select( $this->table, $this->columns, $this->where );
		}
		$this->reset();
		return $result;
	}

	/**
	 * Fetches a single entry
	 * @since 1.0
	 * 
	 * @return string/array
	 */
	public function get_one()
	{
		global $db;
		if ( $this->where == null ) {
			$result = $db->get( $this->table, $this->columns );
		} else {
			$result = $db->get( $this->table, $this->columns, $this->where );
		}
		$this->reset();
		return $result;
	}

	/**
	 * Counts the number of entries
	 * @since 1.0
	 * 
	 * @return array
	 */
	public function count()
	{
		global $db;
		if ( $this->where == null ) {
			$result = $db->count( $this->table );
		} else {
			$result = $db->count( $this->table, $this->where );
		}
		$this->reset();
		return $result;
	}

	/**
	 * Inserts data
	 * @since 1.0
	 * 
	 * @return int
	 */
	public function insert( $data )
	{
		global $db;
		return $db->insert( $this->table, $data );
	}


	/**
	 * Updates data
	 * @since 1.0
	 * 
	 * @return int
	 */
	public function update( $data )
	{
		global $db;
		if ( $this->where == null ) {
			return $db->update( $this->table, $data );
		} else {
			return $db->update( $this->table, $data, $this->where );
		}
	}

	/**
	 * Reset columns and where parameters
	 * @since 1.0
	 * 
	 * @return void
	 */
	private function reset()
	{
		$this->columns = '*';
		$this->where = null;
	}
}
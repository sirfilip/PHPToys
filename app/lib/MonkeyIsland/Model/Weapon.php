<?php

namespace MonkeyIsland\Model;



class Weapon extends Base
{
    protected $_properties = array('name', 'type', 'power_level');

    /**
     * Fetches all weapons
     * 
     * @return array weapons
     */
    public function all()
    {
        return $this->db()
                ->query("SELECT * FROM weapons")
                ->fetchAll(\PDO::FETCH_ASSOC);
    }

    /**
     * Fetches weapon based on its id
     * 
     * @param int $id
     * @return array weapon
     */
    public function get($id)
    {
        $stmt = $this->db()->prepare("SELECT * FROM weapons WHERE id=:id");
        $stmt->execute(array(':id' => $id));
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    /**
     * Creates new weapon
     * 
     * @param array $params
     * @return array weapon
     */
    public function create($params)
    {
        $params = $this->clean_params($params);
        $bindParams = array();
        foreach ($params as $key => $val)
        {
            $bindParams[":{$key}"] = $val;
        }
        $query = "INSERT INTO weapons (".implode(",", array_keys($params)).") VALUES (".implode(",", array_keys($bindParams)).")";
        $stmt = $this->db()->prepare($query);
        $stmt->execute($bindParams);
        $params['id'] = $this->db()->lastInsertId();
        return $params;
    }

    /**
     * Updates a weapon based on its id
     * 
     * @param int $id
     * @param array $params
     * @return array weapon
     */
    public function update($id, $params)
    {
        $params = $this->clean_params($params);
        $set = array();
        $bindParams = array();
        foreach ($params as $key => $val)
        {
            $set[] = "{$key} = :{$key}";
            $bindParams[":{$key}"] = $val;
        }
        $bindParams[":id"] = $id;

        $query = "UPDATE weapons SET ".implode(",", $set)." WHERE id=:id";
        $stmt = $this->db()->prepare($query);
        $stmt->execute($bindParams);
        $params['id'] = $id;
        return $params;
    }

    /**
     * Deletes a weapon
     * 
     * @param int $id
     * @return bool
     */
    public function delete($id)
    {
        $stmt = $this->db()->prepare("DELETE FROM weapons WHERE id=:id");
        return $stmt->execute(array(':id' => $id));
    }
}
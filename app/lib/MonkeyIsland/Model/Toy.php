<?php

namespace MonkeyIsland\Model;

class Toy extends Base
{
    const TYPE_DOG = 1;
    const TYPE_MONKEY = 2;

    protected $_properties = array('name', 'type', 'energy_level');

    /**
     * Fetches all toys of a given type.
     * 
     * @param int $type
     * @return array of toys from a given type
     */
    public function all($type)
    {
        return $this->db()
                ->query("SELECT * FROM toys WHERE type={$type}")
                ->fetchAll(\PDO::FETCH_ASSOC);
    }

    /**
     * Fetches all toys of type dog
     * 
     * @return array dog toys
     */
    public function dogs()
    {
        return $this->all(static::TYPE_DOG);
    }

    /**
     * Fetches all toys of type monkey
     * 
     * @return array monkey toys
     */
    public function monkeys()
    {
        return $this->all(static::TYPE_MONKEY);   
    }

    /**
     * Fetches a toy based on its type and id.
     * 
     * @param int $id
     * @param int $type
     * @return array toy
     */
    public function get($id, $type)
    {
        $stmt = $this->db()->prepare("SELECT * FROM toys WHERE type={$type} AND id=:id");
        $stmt->execute(array(':id' => $id));
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    /**
     * Fetches a dog toy based on its id
     * 
     * @param int $id
     * @return array dog
     */
    public function dog($id)
    {
        return $this->get($id, static::TYPE_DOG);
    }

    /**
     * Fetches a monkey toy based on its id
     * 
     * @param int $id
     * @return array monkey
     */
    public function monkey($id)
    {
        return $this->get($id, static::TYPE_MONKEY);
    }

    /**
     * Creates new toy of a given type
     * 
     * @param array $params
     * @param int $type
     * @return array toy
     */
    public function create($params, $type)
    {
        $params = $this->clean_params($params);
        $params['type'] = $type;
        $bindParams = array();
        foreach ($params as $key => $val)
        {
            $bindParams[":{$key}"] = $val;
        }
        $query = "INSERT INTO toys (".implode(",", array_keys($params)).") VALUES (".implode(",", array_keys($bindParams)).")";
        $stmt = $this->db()->prepare($query);
        $stmt->execute($bindParams);
        $params['id'] = $this->db()->lastInsertId();
        return $params;
    }

    /**
     * Creates new dog 
     * 
     * @param array $params
     * @return array dog
     */
    public function create_dog($params)
    {
        return $this->create($params, static::TYPE_DOG);
    }
    /**
     * Creates new monkey
     * 
     * @param array $params
     * @return array monkey
     */
    public function create_monkey($params)
    {
        return $this->create($params, static::TYPE_MONKEY);
    }

    /**
     * Updates a toy based on the id and type
     * 
     * @param int $id
     * @param array $params
     * @param int $type
     * @return array toy
     */
    public function update($id, $params, $type)
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
        $bindParams[':type'] = $type;

        $query = "UPDATE toys SET ".implode(",", $set)." WHERE id=:id AND type=:type";
        $stmt = $this->db()->prepare($query);
        $stmt->execute($bindParams);
        $params['id'] = $id;
        return $params;
    }
    /**
     * Updates a dog based on its id
     * 
     * @param int $id
     * @param array @params
     * @return array dog
     */
    public function update_dog($id, $params)
    {
        return $this->update($id, $params, static::TYPE_DOG);
    }
    /**
     * Updates a monkey
     * 
     * @param int $id
     * @param array $params
     * @return array monkey
     */
    public function update_monkey($id, $params)
    {
        return $this->update($id, $params, static::TYPE_MONKEY);
    }

    /**
     * Deletes a toy of a given type
     * 
     * @param int $id
     * @param int $type
     * @return bool
     */
    public function delete($id, $type)
    {
        $stmt = $this->db()->prepare("DELETE FROM toys WHERE id=:id AND type=:type");
        return $stmt->execute(array(':type' => $type, ':id' => $id));
    }

    /**
     * Deletes a dog
     * 
     * @param int $id
     * @return bool
     */
    public function delete_dog($id)
    {
        return $this->delete($id, static::TYPE_DOG);
    }
    /**
     * Deletes a monkey
     * 
     * @param int $id
     * @return bool
     */
    public function delete_monkey($id)
    {
        return $this->delete($id, static::TYPE_MONKEY);
    }

}
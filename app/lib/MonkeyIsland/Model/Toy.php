<?php

namespace MonkeyIsland\Model;

class Toy extends Base
{
    const TYPE_DOG = 1;
    const TYPE_MONKEY = 2;

    protected $_properties = array('name', 'type', 'energy_level');

    public function all($type)
    {
        return $this->db()
                ->query("SELECT * FROM toys WHERE type={$type}")
                ->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function dogs()
    {
        return $this->all(static::TYPE_DOG);
    }

    public function monkeys()
    {
        return $this->all(static::TYPE_MONKEY);   
    }

    public function get($id, $type)
    {
        $stmt = $this->db()->prepare("SELECT * FROM toys WHERE type={$type} AND id=:id");
        $stmt->execute(array(':id' => $id));
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    public function dog($id)
    {
        return $this->get($id, static::TYPE_DOG);
    }

    public function monkey($id)
    {
        return $this->get($id, static::TYPE_MONKEY);
    }

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

    public function create_dog($params)
    {
        return $this->create($params, static::TYPE_DOG);
    }
    public function create_monkey($params)
    {
        return $this->create($params, static::TYPE_MONKEY);
    }

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
    public function update_dog($id, $params)
    {
        return $this->update($id, $params, static::TYPE_DOG);
    }
    public function update_monkey($id, $params)
    {
        return $this->update($id, $params, static::TYPE_MONKEY);
    }

    public function delete($id, $type)
    {
        $stmt = $this->db()->prepare("DELETE FROM toys WHERE id=:id AND type=:type");
        return $stmt->execute(array(':type' => $type, ':id' => $id));
    }
    public function delete_dog($id)
    {
        return $this->delete($id, static::TYPE_DOG);
    }
    public function delete_monkey($id)
    {
        return $this->delete($id, static::TYPE_MONKEY);
    }

}
<?php


return array(

    // DOGS CRUD API
    /**
     * Fetches all dog toys (List action)
     */
	'GET /api/cuddly_toys/dogs' => function() {
        $toy_model = new MonkeyIsland\Model\Toy;
		return \PHPWay\Response::json($toy_model->dogs());
	},

    /**
     * Fetches a dog toy resource (Show action)
     */
    'GET /api/cuddly_toys/dogs/(\d+)' => function($id) {
        $toy_model = new MonkeyIsland\Model\Toy;
        $dog = $toy_model->dog($id);
        if ($dog)
        {
            return \PHPWay\Response::json($dog);
        }
        else
        {
            return \PHPWay\Response::page_404("Dog not found"); 
        }
    },

    /** 
     * Creates a new dog toy resource
     * example json input {"name":"Fido","energy_level": 23}
     * all additional properties are discarded.
     * returns a new created resource as json
     */
    'POST /api/cuddly_toys/dogs' => function() {
        $params = \PHPWay\Input::json();
        $toy_model = new MonkeyIsland\Model\Toy;
        $dog = $toy_model->create_dog($params);
        if ($dog) 
        {
            return \PHPWay\Response::json($dog);   
        }
        else
        {
            return \PHPWay\Response::error(array("message" => 'There was an error in saving the object')); 
        }
    },

    /**
     * Updates an existing dog toy resource.
     * If a resource is not found 404 will be returned
     * example json input {"name": "new-fido", "energy_level":123}
     */
    'PUT /api/cuddly_toys/dogs/(\d+)' => function($id) {
        $params = \PHPWay\Input::json();
        $toy_model = new MonkeyIsland\Model\Toy;
        $dog = $toy_model->dog($id);
        if (! $dog) return \PHPWay\Response::page_404("Dog not found");
        return \PHPWay\Response::json($toy_model->update_dog($id, $params)); 
    },

    /**
     * Destroys a dog resource. 
     */
    'DELETE /api/cuddly_toys/dogs/(\d+)' => function($id) {
        $toy_model = new MonkeyIsland\Model\Toy;
        $dog = $toy_model->dog($id);
        if (! $dog) return \PHPWay\Response::page_404("Dog not found");
        $toy_model->delete_dog($id);
        return \PHPWay\Response::json(array('message' => 'Dog deleted successfully'));
    },

    // MONKEYS CRUD API
    /**
     * Fetches all dog toys (List action)
     */
    'GET /api/cuddly_toys/monkeys' => function() {
        $toy_model = new MonkeyIsland\Model\Toy;
        return \PHPWay\Response::json($toy_model->monkeys());
    },

    /**
     * Fetches a toy monkey resource (Show action)
     */
    'GET /api/cuddly_toys/monkeys/(\d+)' => function($id) {
        $toy_model = new MonkeyIsland\Model\Toy;
        $monkey = $toy_model->monkey($id);
        if ($monkey)
        {
            return \PHPWay\Response::json($monkey);
        }
        else
        {
            return \PHPWay\Response::page_404("Dog not found"); 
        }
    },

    /** 
     * Creates a new monkey toy resource
     * example json input {"name":"Fido","energy_level": 23}
     * all additional properties are discarded.
     * returns a new created resource as json
     */
    'POST /api/cuddly_toys/monkeys' => function() {
        $params = \PHPWay\Input::json();
        $toy_model = new MonkeyIsland\Model\Toy;
        $monkey = $toy_model->create_monkey($params);
        if ($monkey) 
        {
            return \PHPWay\Response::json($monkey);   
        }
        else
        {
            return \PHPWay\Response::error(array("message" => 'There was an error in saving the object')); 
        }
    },

    /**
     * Updates an existing monkey toy resource.
     * If a resource is not found 404 will be returned
     * example json input {"name": "new-fido", "energy_level":123}
     */
    'PUT /api/cuddly_toys/monkeys/(\d+)' => function($id) {
        $params = \PHPWay\Input::json();
        $toy_model = new MonkeyIsland\Model\Toy;
        $monkey = $toy_model->monkey($id);
        if (! $monkey) return \PHPWay\Response::page_404("Monkey not found");
        return \PHPWay\Response::json($toy_model->update_monkey($id, $params)); 
    },

    /**
     * Destroys a monkey resource. 
     */
    'DELETE /api/cuddly_toys/monkeys/(\d+)' => function($id) {
        $toy_model = new MonkeyIsland\Model\Toy;
        $monkey = $toy_model->monkey($id);
        if (! $monkey) return \PHPWay\Response::page_404("Monkey not found");
        $toy_model->delete_monkey($id);
        return \PHPWay\Response::json(array('message' => 'Monkey deleted successfully'));
    },

    // WEAPONS CRUD API
    
);
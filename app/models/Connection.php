<?php

class Connection extends BaseModel {
	protected $fillable = array('model1', 'record1', 'model2', 'record2', 'order');
	public static $map = array('model1', 'record1', 'model2', 'record2', 'order');
	public static $translate = false;
	public static $search_map = array('model1', 'record1', 'model2', 'order');

	public function scopeModel1($query, $text)
    {
        return $query->whereModel1($text);
    }

    public function scopeRecord1($query, $int)
    {
        return $query->whereRecord1($int);
    }

    public function scopeModel2($query, $text)
    {
        return $query->whereModel2($text);
    }

    // record1 (type model1) has many record2 (type model2)

    // record2 have many connection to record
    // public static function attach_connection($data)
    // {

    // }

    // record2 have 1 connection to record1
    public static function replace_connection($data)
    {
        // TODO: check connection exists
        // if the same not delete
        // can update connection
        Connection::where('model1', '=', $data['model1'])
                ->where('model2', '=', $data['model2'])
                ->where('record2', '=', $data['record2'])
                ->delete();

        // TODO: order
        $last = Connection::search(array('model1' => $data['model1'], 'record1' => $data['record1'], 'model2' => $data['model2'], 'order' => array('order', 'desc')), 1);
        $data['order'] = $last ? $last->order + 1 : 0;

        return Connection::create($data);
    }

    public static function detach_all($data)
    {
        $connection = Connection::query();
        foreach ($data as $key => $value)
        {
            $connection = $connection->where($key, '=', $value);
        }
        $connection->delete();
    }


}
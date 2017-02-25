<?php
include_once 'tests/fixtures/models/FWTestModelUser.php';

class BasicORM2Test extends TesterCase
{
    public function testAll()
    {
        $query = FWTestModelUser::orm2_all()->toSql();

        Assert::expect($query)->to_equal('SELECT `fw_test_model_users`.* FROM `fw_test_model_users`');
    }

    public function testAllWithOrder()
    {
        $query = FWTestModelUser::orm2_all()->orderBy('id', 'DESC')->toSql();

        Assert::expect($query)->to_equal('SELECT `fw_test_model_users`.* FROM `fw_test_model_users` ORDER BY id DESC');
    }

    public function testWhere()
    {
        $query = FWTestModelUser::orm2_where("created_at BETWEEN ? AND ? AND series_id = ?", ['2017-01-01 00:00:00', '2017-01-01 23:59:59', 2])->toSql();

        Assert::expect($query)->to_equal('SELECT `fw_test_model_users`.* FROM `fw_test_model_users` WHERE created_at BETWEEN ? AND ? AND series_id = ?');
    }

    # $invoices_in_month = Invoice::where("created_at BETWEEN \"{$from}\" AND \"{$to}\" AND series_id = ?", ['series_id' => $seria]);

}

<?php
include_once 'tests/fixtures/support/ParentChildGrandsonMysqlTables.php';

class ValidatorNestedAttributesTest extends TesterCase
{
    use ParentChildGrandsonMysqlTables;

//    // create new object with first level nested resources
//    public function testValidObjectWithNestedAttributes()
//    {
//        $this->pending();
//        $this->createParentChildGrandsonMysqlTables();
//        $data = [
//            'name'=>'Parent name',
//            'childs_attributes' => [
//                ['address' => 'email1@test.com'],
//                ['address' => 'email2@test.com'],
//            ]
//        ];
//
//        $parent = new TesterParentModel($data);
//        $valid = new Validator($parent, $parent->validationRules());
//
//        Assert::expect($valid->isValid())->to_equal(true);
//    }
//
//    // check vaidation for nested resources (address in unique, required and not blank allowed)
//    public function testValidObjectWithNestedAttributesWithRequiredError()
//    {
//        $this->pending();
//        $this->createParentChildGrandsonMysqlTables();
//        $data = [
//            'name'=>'Parent name',
//            'childs_attributes' => [
//                ['address' => ''],
//                ['address' => 'email1@test.com'],
//                ['address' => ''],
//                ['address' => 'email2@test.com']
//            ]
//        ];
//
//        $parent = new TesterParentModel($data);
//
//        Assert::expect($parent->isValid())->to_equal(false);
//        Assert::expect(count($parent->errors))->to_equal(2);
//        Assert::expect($parent->errors['childs[0].address'][0])->to_equal('is required.');
//        Assert::expect($parent->errors['childs[0].address'][1])->to_equal('email is not valid.');
//        Assert::expect($parent->errors['childs[0].address'][2])->to_equal('is not unique.');
//        Assert::expect($parent->errors['childs[2].address'][0])->to_equal('is required.');
//        Assert::expect($parent->errors['childs[2].address'][1])->to_equal('email is not valid.');
//        Assert::expect($parent->errors['childs[2].address'][2])->to_equal('is not unique.');
//    }
//
//    // add childs to exist object
//    public function testWithOneSaveObject()
//    {
//        $this->pending();
//        $this->createParentChildGrandsonMysqlTables();
//        $child = new TesterChildModel(['address' => 'email@test.com', 'tester_parent_model_id' => 0]);
//        $child->save();
//
//        $data = [
//            'name'=>'Parent name',
//            'childs_attributes' => [
//                ['address' => ''],
//                ['address' => 'email@test.com'],
//                ['address' => 'email@test.com']
//            ]
//        ];
//        $parent = new TesterParentModel($data);
//
//        Assert::expect($parent->isValid())->to_equal(false);
//        Assert::expect(count($parent->errors))->to_equal(3);
//        Assert::expect($parent->errors['childs[0].address'][0])->to_equal('is required.');
//        Assert::expect($parent->errors['childs[0].address'][1])->to_equal('email is not valid.');
//        Assert::expect($parent->errors['childs[1].address'][0])->to_equal('is not unique.');
//        Assert::expect($parent->errors['childs[2].address'][0])->to_equal('is not unique.');
//    }
//
//    //
//    public function testNotValidParentObject()
//    {
//        $this->pending();
//        $this->createParentChildGrandsonMysqlTables();
//        $data = [
//            'name'=>'',
//            'childs_attributes' => [
//                ['address' => ''],
//                ['address' => 'email@test.com'],
//            ]
//        ];
//
//        $parent = new TesterParentModel($data);
//
//        Assert::expect($parent->isValid())->to_equal(false);
//
//        Assert::expect(count($parent->errors))->to_equal(2);
//        Assert::expect($parent->errors['name'][0])->to_equal('is required.');
//
//        Assert::expect($parent->errors['childs[0].address'][0])->to_equal('is required.');
//        Assert::expect($parent->errors['childs[0].address'][1])->to_equal('email is not valid.');
//    }
//
//    // save with two level nested objects
//    public function testWithThreeLevelSave()
//    {
//        $this->pending();
//        $this->createParentChildGrandsonMysqlTables();
//        $data = [
//            'name'=>'Parent name',
//            'childs_attributes' => [
//                [
//                    'address' => 'email1@test.com',
//                    'grandsons_attributes' => [
//                        ['description' => 'Lorem ipsum']
//                    ]
//                ]
//            ]
//        ];
//
//        $parent = new TesterParentModel($data);
//
//        Assert::expect($parent->isValid())->to_equal(true);
//    }
//
//    // try to save object to not belongs to parent
//    public function testSaveWithManipulateParentId()
//    {
//        $this->pending();
//        $this->createParentChildGrandsonMysqlTables();
//
//        $parent = new TesterParentModel(['name' => 'Parent name']);
//        $parent->save();
//
//        $child1 = new TesterChildModel(['address' => 'email1@test.com', 'tester_parent_model_id' => $parent->id]);
//        $child1->save();
//
//        $child2 = new TesterChildModel(['address' => 'email2@test.com', 'tester_parent_model_id' => $parent->id]);
//        $child2->save();
//
//        $child3 = new TesterChildModel(['address' => 'email3@test.com', 'tester_parent_model_id' => 999]);
//        $child3->save();
//
//        $data = [
//            'childs_attributes' => [
//                ['id' => 1, 'address' => 'email@test.com'],
//                ['id' => 3, 'address' => 'email@test.com']
//            ]
//        ];
//
//        $parent->update($data);
//
//        Assert::expect($parent->isValid())->to_equal(false);
//        Assert::expect(count($parent->errors))->to_equal(1);
//        Assert::expect($parent->errors['childs[1].id'][0])->to_equal('Item not belongs to this parent.');
//    }
//
//    // test validation on granson object (required description)
//    public function testWithThreeLevelSaveGrandsonError()
//    {
//        $this->pending();
//        $this->createParentChildGrandsonMysqlTables();
//        $data = [
//            'name'=>'Parent name',
//            'childs_attributes' => [
//                [
//                    'address' => 'email@test.com',
//                    'grandsons_attributes' => [
//                        ['description' => '']
//                    ]
//                ]
//            ]
//        ];
//
//        $parent = new TesterParentModel($data);
//
//        Assert::expect($parent->isValid())->to_equal(false);
//        Assert::expect(count($parent->errors))->to_equal(1);
//        Assert::expect($parent->errors['childs[0].grandsons[0].description'][0])->to_equal('is required.');
//    }
//
//    // test childs validation with grandson
//    public function testWithThreeLevelSaveDubleError()
//    {
//        $this->pending();
//        $this->createParentChildGrandsonMysqlTables();
//        $data = [
//            'name'=>'Parent name',
//            'childs_attributes' => [
//                [
//                    'address' => 'email@test.com',
//                    'grandsons_attributes' => [
//                        ['description' => '']
//                    ]
//                ],
//                [
//                    'address' => 'email@test.com',
//                    'grandsons_attributes' => [
//                        ['description' => 'Test']
//                    ]
//                ]
//            ]
//        ];
//
//        $parent = new TesterParentModel($data);
//
//        Assert::expect($parent->isValid())->to_equal(false);
//        Assert::expect(count($parent->errors))->to_equal(3);
//        Assert::expect($parent->errors['childs[0].address'][0])->to_equal('is not unique.');
//        Assert::expect($parent->errors['childs[0].grandsons[0].description'][0])->to_equal('is required.');
//        Assert::expect($parent->errors['childs[1].address'][0])->to_equal('is not unique.');
//    }
//
//    // update childs and add new child object
//    public function testUpdateObjectsAndAddNew()
//    {
//        $this->pending();
//        $this->createParentChildGrandsonMysqlTables();
//
//        $child1 = new TesterChildModel(['address' => 'email1@test.com', 'tester_parent_model_id' => 1]);
//        $child1->save();
//
//        $child2 = new TesterChildModel(['address' => 'email2@test.com', 'tester_parent_model_id' => 1]);
//        $child2->save();
//
//        $child3 = new TesterChildModel(['address' => 'email3@test.com', 'tester_parent_model_id' => 1]);
//        $child3->save();
//
//        $data = [
//            'name'=>'Parent name',
//            'childs_attributes' => [
//                ['id' => 1, 'address' => 'new_email1@test.com'],
//                ['id' => 2, 'address' => 'new_email2@test.com'],
//                ['id' => 3, 'address' => ''],
//                ['address' => 'other-address@com.pl']
//                // ['address' => 'kontakt@com.pl']
//                // taki adress jest juz w bazie danych ale wczesniej zostal zmieniony
//            ]
//        ];
//
//        $parent = new TesterParentModel($data);
//
//        Assert::expect($parent->isValid())->to_equal(false);
//        Assert::expect(count($parent->errors))->to_equal(1);
//        Assert::expect($parent->errors['childs[2].address'][0])->to_equal('is required.');
//        Assert::expect($parent->errors['childs[2].address'][1])->to_equal('email is not valid.');
//    }
//
//    // test delete validation object
//    public function testWithObjectToDelete()
//    {
//        $this->pending();
//        $child1 = new TesterChildModel(['address' => 'email@test.com', 'tester_parent_model_id' => 1]);
//        $child1->save();
//
//        $data = [
//            'name'=>'Parent name',
//            'childs_attributes' => [
//                ['id' => 1, 'address' => '', '_destroy' => '1'],
//                ['id' => 1, 'address' => '', '_destroy' => 1],
//                ['id' => 1, 'address' => '', '_destroy' => 'wrong'],
//            ]
//        ];
//
//        $parent = new TesterParentModel($data);
//        Assert::expect($parent->isValid())->to_equal(false);
//
//        Assert::expect(count($parent->errors))->to_equal(1);
//        Assert::expect($parent->errors['childs[2].address'][0])->to_equal('is required.');
//        Assert::expect($parent->errors['childs[2].address'][1])->to_equal('email is not valid.');
//
//        # $this->dropDownParentChildGrandsonMysqlTables();
//    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTriggers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('
        CREATE TRIGGER tr_check_availability AFTER UPDATE ON `productcontrols` FOR EACH ROW
        BEGIN
DECLARE totalno INT;
SET totalno = 0;
SELECT sum(productcontrols.quantity) INTO totalno FROM productcontrols WHERE productcontrols.product_id= NEW.product_id;

IF totalno = 0 THEN

UPDATE products SET availability = 0 WHERE `products`.`id` = NEW.product_id;

end IF;

IF totalno > 0 THEN

UPDATE products SET availability = 1 WHERE `products`.`id` = NEW.product_id;

end IF;

END
        ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared('DROP TRIGGER `tr_check_availability`');
    }
}

 <?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Legislation extends Model
{
  protected $table = 'legislations';
  protected $fillable = ['Contract_legis','Name_legis','Idcard_legis','BrandCar_legis','register_legis','YearCar_legis',
                        'Category_legis','DateDue_legis','Pay_legis','BalancePrice_legis','DateSue_legis','DateVAT_legis',
                        'NameGT_legis','IdcardGT_legis','Realty_legis','Note','Flag'];

}

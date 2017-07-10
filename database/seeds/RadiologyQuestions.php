<?php

use App\RadiologyQuestion;
use Illuminate\Database\Seeder;

class RadiologyQuestions extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        RadiologyQuestion::create(['id'=> 1,'en_name'=>'Have the patient performed any other test at the center before?','is_for_women'=>false,'ar_name'=>'هل تم اجراء فحوصات سابقة بالمركز؟']);
        RadiologyQuestion::create(['id'=> 2,'en_name'=>'Have the patient had any surgerys before?','is_for_women'=>false,'ar_name'=>'هل تم اجراء عمليات سابقة؟']);
        RadiologyQuestion::create(['id'=> 3,'en_name'=>'have the patient had application of screws , plates or any Prosthetic devices?','is_for_women'=>false,'ar_name'=>'هل تم تركيب مسامير او شرائح او اجهزة تعويضية؟']);
        RadiologyQuestion::create(['id'=> 4,'en_name'=>'Do you have a pacemaker?','is_for_women'=>false,'ar_name'=>'هل يوجد جهاز لتنظيم ضربات القلب؟']);
        RadiologyQuestion::create(['id'=> 5,'en_name'=>'Had the patient any metal teeth?','is_for_women'=>false,'ar_name'=>'هل يوجد تركيبات اسنان معدنية؟']);
        RadiologyQuestion::create(['id'=> 6,'en_name'=>'Is the patient fasting?','is_for_women'=>false,'ar_name'=>'هل المريض صائم؟']);
        RadiologyQuestion::create(['id'=> 7,'en_name'=>'did the patient undergo  a contrast radiography before?','is_for_women'=>false,'ar_name'=>'هل تم عمل اشعة بالصبغة سابقا؟']);
        RadiologyQuestion::create(['id'=> 8,'en_name'=>'Is the patient sensitive to any drug or food types?','is_for_women'=>false,'ar_name'=>'هل يوجد حساسية من اية عقاقير او مواد غذائية؟']);
        RadiologyQuestion::create(['id'=> 9,'en_name'=>'Is the patient suffering from any of the blood pressure diseases?','is_for_women'=>false,'ar_name'=>'هل المريض يعاني من امراض ضغط الدم؟']);
        RadiologyQuestion::create(['id'=> 10,'en_name'=>'Is the patient suffering from Diabetes?','is_for_women'=>false,'ar_name'=>'هل المريض يعاني من مرض السكر؟']);
        RadiologyQuestion::create(['id'=> 11,'en_name'=>'Is the patient suffering from any of the renal diseases?','is_for_women'=>false,'ar_name'=>'هل المريض يعاني من امراض بالكلي؟']);
        RadiologyQuestion::create(['id'=> 12,'en_name'=>'Is the patient suffering from any of the thyroid gland diseases?','is_for_women'=>false,'ar_name'=>'هل المريض يعاني من امراض بالغدة الدرقية؟']);
        RadiologyQuestion::create(['id'=> 13,'en_name'=>'Is the patient taking any of the thyroid gland drugs?','is_for_women'=>false,'ar_name'=>'هل المريض ياخذ علاج للغدة الدرقية؟']);
        RadiologyQuestion::create(['id'=> 14,'en_name'=>'Is the patient taking Chemotherapy?','is_for_women'=>false,'ar_name'=>'هل يتم اخذ علاج كيماوى؟']);
        RadiologyQuestion::create(['id'=> 15,'en_name'=>'what is the Diabetic drugs do the patient take?','is_for_women'=>false,'ar_name'=>'ما هي ادوية السكر المستخدمة؟']);
        RadiologyQuestion::create(['id'=> 16,'en_name'=>'when was the last Chemotheraputic session?','is_for_women'=>false,'ar_name'=>'ما هو ميعاد اخر جلسة كيماوي؟']);
        RadiologyQuestion::create(['id'=> 17,'en_name'=>'Is the patient pregnant?','is_for_women'=>true,'ar_name'=>'هل المريضة حامل؟']);
        RadiologyQuestion::create(['id'=> 18,'en_name'=>'When was your last Menstruation?','is_for_women'=>true,'ar_name'=>'ما هو ميعاد اخر دورة؟']);
    }
}

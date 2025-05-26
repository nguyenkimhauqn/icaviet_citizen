<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use App\Models\Category;
use App\Models\Question;
use App\Models\Answer;

class N400Seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $N400Data = [
            'Following Instructions, Truth Oath, Small Talk' => [
                ['How are you feeling?', 'Good! Thank you for asking.'],
                ['Can you raise your right hand?', 'Yes, I can.'],
                ['Do you understand the oath?', 'Yes, I understand.'],
            ],
            'Information About Your Eligibility' => [
                ['Are you at least 18 years old?', 'Yes, I am 18 or older.'],
                ['Are you a lawful permanent resident?', 'Yes, I am.'],
                ['Have you lived in the U.S. for at least 5 years?', 'Yes, I have.'],
                ['Have you ever claimed to be a U.S. citizen?', 'No, I have not.'],
            ],
            'Information About You' => [
                ['What is your full name?', 'John Doe.'],
                ['What is your date of birth?', 'January 1, 1990.'],
                ['Where were you born?', 'Vietnam.'],
                ['What is your height and weight?', '5 feet 8 inches, 160 pounds.'],
                ['Have you used other names?', 'No, I have not.'],
            ],
            'Accommodations for Individuals With Disabilities and/or Impairments' => [
                ['Do you need any accommodations?', 'No, I do not.'],
                ['Do you have a physical or mental impairment?', 'No, I do not.'],
            ],
            'Information to Contact You' => [
                ['What is your phone number?', '123-456-7890.'],
                ['What is your email address?', 'john.doe@example.com.'],
                ['What is your mailing address?', '123 Main Street, San Jose, CA.'],
            ],
            'Information About Your Residence' => [
                ['Where do you currently live?', '123 Main Street, San Jose, CA.'],
                ['How long have you lived there?', '3 years.'],
                ['Do you live with anyone else?', 'Yes, with my family.'],
                ['Have you moved in the past 5 years?', 'Yes, once.'],
            ],
            'Information About Your Parents' => [
                ['What is your mother\'s name?', 'Jane Doe.'],
                ['What is your father\'s name?', 'Richard Doe.'],
                ['Are your parents U.S. citizens?', 'No, they are not.'],
                ['Where were your parents born?', 'Vietnam.'],
            ],
            'Biographic Information' => [
                ['What is your gender?', 'Male.'],
                ['What is your race?', 'Asian.'],
                ['What is the color of your eyes?', 'Brown.'],
                ['What is the color of your hair?', 'Black.'],
                ['What is your height?', '5 feet 8 inches.'],
            ],
            'Information About Your Employment and Schools You Attended' => [
                ['Where do you work?', 'ABC Company.'],
                ['What is your occupation?', 'Software Engineer.'],
                ['What school did you last attend?', 'XYZ University.'],
                ['What is your work schedule?', 'Monday to Friday.'],
                ['Have you studied in the last 5 years?', 'Yes.'],
            ],
            'Time Outside the United States' => [
                ['Have you traveled outside the U.S. in the last 5 years?', 'Yes, two times.'],
                ['What countries did you visit?', 'Canada and Mexico.'],
                ['How long was your last trip?', '10 days.'],
                ['Why did you travel?', 'Vacation.'],
                ['When did you leave and return?', 'Left July 1, returned July 10.'],
            ],
            'Information About Your Marital History' => [
                ['Are you currently married?', 'Yes, I am.'],
                ['What is your spouse’s name?', 'Jane Smith.'],
                ['When did you get married?', 'June 1, 2015.'],
                ['Have you been married before?', 'No, I haven’t.'],
            ],
            'Information About Your Children' => [
                ['Do you have children?', 'Yes, two.'],
                ['What are their names?', 'Lily and Max.'],
                ['Where do they live?', 'With me.'],
                ['How old are they?', '8 and 5.'],
                ['Are they U.S. citizens?', 'Yes.'],
            ],
            'Additional Information About You' => [
                ['Have you ever failed to pay taxes?', 'No, I have not.'],
                ['Have you ever been arrested?', 'No, never.'],
                ['Have you been a member of any organization?', 'No.'],
                ['Do you support the Constitution?', 'Yes, I do.'],
                ['Are you willing to take the Oath of Allegiance?', 'Yes.'],
                ['Have you ever committed a crime?', 'No.'],
            ],
        ];

        foreach($N400Data as $categoryTitle => $qaList) {
            $category = Category::where('title_en', $categoryTitle)->first();

            if (!$category) continue;   
            foreach ($qaList as $index => [$questionText, $answerText]) {
                $question = Question::create([
                    'content' => $questionText,
                    'audio_path' => null,
                    'category_id' => $category->id,
                    'topic_id' => 4, // ID co name N400

                ]);

                Answer::create([
                    'question_id' => $question->id,
                    'content' => $answerText,
                    'is_correct' => true,
                    'audio_path' => null,
                ]);
            }
        }
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['category_name' => 'Theft', 'category_details' => 'Crimes involving the unlawful taking of someone else\'s property.'],
            ['category_name' => 'Assault', 'category_details' => 'Crimes involving physical harm or threats of harm to individuals.'],
            ['category_name' => 'Fraud', 'category_details' => 'Crimes involving deception for financial or personal gain.'],
            ['category_name' => 'Burglary', 'category_details' => 'Crimes involving unlawful entry into a building with the intent to commit a crime.'],
            ['category_name' => 'Vandalism', 'category_details' => 'Crimes involving the intentional destruction of property.'],
            ['category_name' => 'Drug Offenses', 'category_details' => 'Crimes involving the illegal possession, distribution, or manufacture of controlled substances.'],
            ['category_name' => 'Robbery', 'category_details' => 'Crimes involving the use of force or intimidation to take property from someone.'],
            ['category_name' => 'Sexual Offenses', 'category_details' => 'Crimes involving sexual activity without consent.'],
            ['category_name' => 'Homicide', 'category_details' => 'Crimes involving the unlawful killing of another person.'],
            ['category_name' => 'Cybercrime', 'category_details' => 'Crimes involving computers or the internet, such as hacking or online fraud.'],
        ];

        foreach ($categories as $category) {
            Category::create([
                'category_name' => $category['category_name'],
                'slug' => Str::slug($category['category_name']), // Generate slug from category name
                'category_details' => $category['category_details'],
            ]);
        }
    }
}

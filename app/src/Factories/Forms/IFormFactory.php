<?php declare(strict_types=1);

namespace App\Factories\Forms;

use App\UI\Form;

interface IFormFactory {

	public function create(): Form;

}

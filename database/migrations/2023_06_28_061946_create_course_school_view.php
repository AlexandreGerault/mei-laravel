<?php

use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement($this->createView());
    }

    public function down(): void
    {
        DB::statement($this->dropView());
    }

    private function createView(): string
    {
        return <<<'SQL'
CREATE OR REPLACE VIEW course_school_view AS
SELECT courses.id as course_id, schools.id as school_id FROM courses
INNER JOIN course_specialism ON courses.id = course_specialism.course_id
INNER JOIN specialisms ON course_specialism.specialism_id = specialisms.id
INNER JOIN schools ON specialisms.school_id = schools.id
SQL;
    }

    private function dropView(): string
    {
        return <<<'SQL'
DROP VIEW IF EXISTS course_school_view;
SQL;
    }
};

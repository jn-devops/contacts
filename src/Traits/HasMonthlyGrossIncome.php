<?php

namespace Homeful\Contacts\Traits;

use Homeful\Contacts\Classes\EmploymentMetadata;

trait HasMonthlyGrossIncome
{
    /**
     * Calculate the total monthly gross income from both the customer's main employment
     * and the employment records of all co-borrowers.
     *
     * This method uses Laravel collections and Spatie DataCollection to handle nested data efficiently.
     *
     * ## Step-by-Step Explanation:
     *
     * 1. **Main Employment Collection:**
     * - The customer's employment data is converted into a collection using `resolveOptionalCollection()`.
     * - The `sum()` method is applied to accumulate the `monthly_gross_income` values.
     *
     * 2. **Co-Borrowers’ Employment Collection:**
     * - The co-borrowers' employment data is processed using `flatMap()` to handle nested arrays.
     * - `flatMap()` flattens the nested arrays into a single collection for summing the `monthly_gross_income`.
     *
     * ## Why We Use `flatMap()`:
     * Co-borrowers' employment records are nested arrays within the co-borrowers collection.
     * `flatMap()` flattens this nested structure into a single collection, allowing us to directly sum the values.
     *
     * **Example:**
     * - The main `employment` collection:
     *     - Job 1: 60,000
     *     - Job 2: 20,000
     *
     * - Co-borrowers’ employment:
     *     - Co-borrower 1: Job 1: 50,000
     *     - Co-borrower 2: Job 1: 40,000
     *
     * **Total Calculation:**
     * 60,000 + 20,000 + 50,000 + 40,000 = **170,000**
     *
     * ## Edge Case Handling:
     * - If `employment` or `co_borrowers` is null or empty, `resolveOptionalCollection()` ensures the result is an empty collection,
     *   preventing errors and returning `0.0` as the sum.
     *
     * @return float The total monthly gross income.
     */
    public function getMonthlyGrossIncome(): float
    {
        // Sum from the main employment collection
        $mainEmploymentIncome = resolveOptionalCollection($this->employment)
            ->sum(fn($employment) => $employment->monthly_gross_income);

        // Sum from the co-borrowers' employment collection
        $coBorrowerIncome = resolveOptionalCollection($this->co_borrowers)
            ->flatMap(fn($coBorrower) => resolveOptionalCollection($coBorrower->employment))
            ->sum(fn($employment) => $employment->monthly_gross_income);

        // Return total income
        return $mainEmploymentIncome + $coBorrowerIncome;
    }
}

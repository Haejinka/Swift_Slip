<?php
// Include the database connection
include('../connect.php');

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["generate_payroll"])) {
    // Update hours worked
    $updateHoursQuery = "
        UPDATE `payroll` p
        JOIN (
          SELECT 
            a.`employee_id`, 
            SUM(a.`hours_worked`) AS `total_hours_worked`
          FROM `attendance` a
          GROUP BY a.`employee_id`
        ) a ON p.`employee_id` = a.`employee_id`
        SET p.`hours_worked` = a.`total_hours_worked`
    ";

    // Update hourly rate
    $updateHourlyRateQuery = "
        UPDATE `payroll` p
        JOIN (
          SELECT 
            e.`employee_id`, 
            j.`hourly_rate`
          FROM `employee` e
          JOIN `jobposition` j ON e.`position_id` = j.`position_id`
        ) j ON p.`employee_id` = j.`employee_id`
        SET p.`hourly_rate` = j.`hourly_rate`
    ";

    // Update gross and net pay
    $updateGrossNetQuery = "
        UPDATE payroll p
        JOIN deductions d ON p.deduction_id = d.deduction_id
        SET p.gross_pay = p.hours_worked * p.hourly_rate,
            p.net_pay = (p.hours_worked * p.hourly_rate) * (1 - d.deduction_amount)
    ";

    // Execute the queries
    if (
        $con->query($updateHoursQuery) === TRUE &&
        $con->query($updateHourlyRateQuery) === TRUE &&
        $con->query($updateGrossNetQuery) === TRUE
    ) {
        // Redirect to viewpayroll.php
        header("Location: viewpayroll.php");
        exit;
    } else {
        echo "Error generating payroll: ";
    }
}
?>

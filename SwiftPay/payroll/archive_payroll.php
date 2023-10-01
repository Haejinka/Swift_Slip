<?php
include '../connect.php';

if (isset($_GET['payroll_id'])) {
    $payrollId = $_GET['payroll_id'];

    // Retrieve the payroll record from the payroll table
    $selectQuery = "SELECT * FROM payroll WHERE payroll_id = '$payrollId'";
    $result = mysqli_query($con, $selectQuery);

    if ($row = mysqli_fetch_assoc($result)) {
        // Insert the payroll record into the archive_payroll table
        $insertQuery = "
            INSERT INTO archive_payroll (payroll_id, employee_id, pay_term, hours_worked, hourly_rate, net_pay, gross_pay, total_deduct_p, total_deduct_f)
            VALUES (
                '{$row['payroll_id']}',
                '{$row['employee_id']}',
                '{$row['pay_term']}',
                '{$row['hours_worked']}',
                '{$row['hourly_rate']}',
                '{$row['net_pay']}',
                '{$row['gross_pay']}',
                '{$row['total_deduct_p']}',
                '{$row['total_deduct_f']}'
            )
        ";
        mysqli_query($con, $insertQuery);

        // Delete the payroll record from the payroll table
        $deleteQuery = "DELETE FROM payroll WHERE payroll_id = '$payrollId'";
        mysqli_query($con, $deleteQuery);

        // Redirect back to the payroll list page
        header("Location: viewpayroll.php");
        exit();
    }
}
?>

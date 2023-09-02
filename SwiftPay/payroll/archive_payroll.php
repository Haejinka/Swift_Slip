<?php
include '../connect.php';

// Check if the payroll_id is provided in the URL
if (isset($_GET['payroll_id'])) {
    $payroll_id = $_GET['payroll_id'];

    // Fetch the payroll record to be archived
    $query = "SELECT * FROM payroll WHERE payroll_id = '$payroll_id'";
    $result = mysqli_query($con, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $payrollData = mysqli_fetch_assoc($result);

        // Insert the payroll record into the archive table
        $archiveQuery = "INSERT INTO archive_payroll (parc_id, employee_id, pay_term, hours_worked, hourly_rate, deduction_id, net_pay, gross_pay) 
                         VALUES ('{$payrollData['payroll_id']}', '{$payrollData['employee_id']}', '{$payrollData['pay_term']}', '{$payrollData['hours_worked']}', '{$payrollData['hourly_rate']}', '{$payrollData['deduction_id']}', '{$payrollData['net_pay']}', '{$payrollData['gross_pay']}')";
        $archiveResult = mysqli_query($con, $archiveQuery);

        if ($archiveResult) {
            // Successfully archived, now delete from main payroll table
            $deleteQuery = "DELETE FROM payroll WHERE payroll_id = '$payroll_id'";
            $deleteResult = mysqli_query($con, $deleteQuery);

            if ($deleteResult) {
                // Record archived and deleted successfully
                header("Location: viewpayroll.php");
                exit();
            } else {
                // Error deleting payroll record
                echo "ERROR DELETING PAYROLL: " . mysqli_error($con);
            }
        } else {
            // Error archiving payroll record
            echo "ERROR archiving payroll: " . mysqli_error($con);
        }
    } else {
        // Payroll record not found
        echo "Cannot find payroll record";
    }
}
?>

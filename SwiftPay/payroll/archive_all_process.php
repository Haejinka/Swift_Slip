<?php
include '../connect.php';

$query = "SELECT * FROM payroll";
$result = mysqli_query($con, $query);

if ($result && mysqli_num_rows($result) > 0) {
    while ($payrollData = mysqli_fetch_assoc($result)) {
        $archiveQuery = "INSERT INTO archive_payroll (parc_id, employee_id, pay_term, deduction_id, hours_worked, hourly_rate, gross_pay, net_pay) 
                         VALUES ('{$payrollData['payroll_id']}', '{$payrollData['employee_id']}', '{$payrollData['pay_term']}', '{$payrollData['deduction_id']}', '{$payrollData['hours_worked']}', '{$payrollData['hourly_rate']}', '{$payrollData['gross_pay']}', '{$payrollData['net_pay']}')";
        $archiveResult = mysqli_query($con, $archiveQuery);

        if ($archiveResult) {
            $deleteQuery = "DELETE FROM payroll WHERE payroll_id = '{$payrollData['payroll_id']}'";
            $deleteResult = mysqli_query($con, $deleteQuery);

            if (!$deleteResult) {
                echo "Error deleting payroll record: " . mysqli_error($con);
                exit();
            }
        } else {
            echo "Error archiving payroll record: " . mysqli_error($con);
            exit();
        }
    }

    header("Location: viewpayroll.php");
    exit();
} else {
    echo "No payroll records found";
}
?>

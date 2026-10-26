<?php

function calculateDeposit($openingBalance, $transactionAmount) {
    return $openingBalance + $transactionAmount;
}

function calculateWithdrawal($openingBalance, $transactionAmount) {
    return $openingBalance - $transactionAmount;
}

function calculateTransactionFee($transactionType, $transactionAmount) {
    $fee = 0;
    if ($transactionType == "Withdrawal") {
        if ($transactionAmount < 500) {
            $fee = 2;
        } else {
            $fee = 5;
        }
    } else {
        $fee = 0; 
    }
    return $fee;
}

function calculateInterest($accountType, $finalBalance, $accountDuration) {
    $rate = 0;
    if ($accountType == "Savings") {
        $rate = 0.05;
    } elseif ($accountType == "Current") {
        $rate = 0.02;
    } elseif ($accountType == "Business") {
        $rate = 0.03;
    }
    return $finalBalance * $rate * $accountDuration;
}


function calculateTotalCharges($transactionFee) {
    return $transactionFee;
}

function calculateFinalBalance($openingBalance, $transactionType, $transactionAmount, $totalCharges) {
    $finalBalance = 0;
    if ($transactionType == "Deposit") {
        $finalBalance = $openingBalance + $transactionAmount - $totalCharges;
    } elseif ($transactionType == "Withdrawal") {
        $finalBalance = $openingBalance - $transactionAmount - $totalCharges;
    }
    return $finalBalance;
}

function checkAccountStatus($finalBalance) {
    $status = "";
    if ($finalBalance >= 5000) {
        $status = "High Balance";
    } elseif ($finalBalance >= 1000 && $finalBalance < 5000) {
        $status = "Medium Balance";
    } else {
        $status = "Low Balance";
    }
    return $status;
}


function calculateFutureBalance($finalBalance, $interest, $duration = 1) {
    return $finalBalance + $interest;
}
?>
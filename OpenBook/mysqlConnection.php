<?php
function getMysqlConnnection()
{
    $mysqli = new mysqli('mars.cs.qc.cuny.edu', 'supr1424', '23371424', 'supr1424');
    // Check connection
    if ($mysqli->connect_errno) {
        throw new Exception('Mysql error occurred ' . $mysqli->connect_errno);
    }

    return $mysqli;
}

function getQuestions($testId)
{
    $mysqli = getMysqlConnnection();

    // Perform query
    if ($stmt = $mysqli->prepare("SELECT * FROM question INNER JOIN questionset_question ON question.question_id=questionset_question.question_id INNER JOIN questiontype ON question.question_type=questiontype.code  WHERE questionset_id=?")) {

        /* bind parameters for markers */
        $stmt->bind_param("s", $testId);

        /* execute query */
        $stmt->execute();

        /* instead of bind_result: */
        $result = $stmt->get_result();

        $questions = $result->fetch_all(MYSQLI_ASSOC);

        /* close statement */
        $stmt->close();

        return $questions;
    }
}
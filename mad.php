<?php
// Sample associative array mapping register numbers to names
$students = array(
        "001" => "AARTHI J",
        "002" => "ABUTHAHIR M",
        "003" => "AHAMED ABDULLAH M",
        "004" => "ARAVINDH S",
        "005" => "BAVITHRA M K",
        "006" => "BHARATHKUMAAR A",
		"007" => "BLESSY A ",
		"008" => "DESIKA R S ",
		"009" => "DHARANI DEVI S ",
		"010" => "DHARUN P ",
		"011" => "FAHMIDHA S",
		"012" => "GAYATHRI B ",
		"013" => "HARI KRISHNAN E",
		"014" => "HARINI S",
		"015" => "JEEVAPRIYA S ",
		"016" => "KANAGA SAKTHI R",
		"017" => "KANISHKA M ",
		"018" => "KEERTHANA S",
		"019" => "KRUSHNA RAMKUMAR R S",
		"020" => "MAHALAKSHMI C ",
		"021" => "MEERA FATHIMA M ",
		"022" => "MOHANRAJ G",
		"023" => "NANDHINI S ",
		"024" => "NANDHU R ",
		"025" => "PRABAHARAN S",
		"026" => "PRABHAHARAN S ",
		"027" => "PRAVEENA A",
		"028" => "PRAVEENA R",
		"029" => "PREETHA N ",
		"030" => "PRIYANGA M ",
		"031" => "RAJASREE A",
		"032" => "RAMKUMAR M ",
		"033" => "RAMNARAYAN D ",
		"034" => "RAMYAPPRABHA G",
		"035" => "RENGANATHAN S ",
		"036" => "SHOBA K",
		"037" => "SINDHUJA J ",
		"038" => "SIVA SANTHOSHINI S",
		"039" => "SIYAMALA C ",
		"040" => "SNEKA M",
		"041" => "SNEKA PL",
		"042" => "SRIVARDHANI K",
		"043" => "SURYA T ",
		"044" => "SWATHI E",
		"045" => "SWETHA K",
		"046" => "SWETHA M",
		"047" => "TAMILSELVAN K ",
		"048" => "THAIYALNAYAKI A",
		"049" => "THARANI BALAN J ",
		"050" => "VIJAYARAJESWARI V ",
		"051" => "VINEETH T ",
		"052" => "VINODHA S",
		"053" => "VISHALI S ",
		"054" => "YOGINI K ",
		"055" => "YUVASRI P"

    // Add more students as needed
);

// Function to generate absentees list file
function generateAbsenteesFile($absentees) {
    // Generate filename with current date
    $date = date('d-m-Y');
    $file = "absentees_list_$date.txt";
    $content = "Absentees List for MOBILE APPLICATION DEVELOPMENT $date:\n\n";
    foreach ($absentees as $registerNo => $name) {
        $content .= "Register No: $registerNo - Name: $name\n";
    }
    file_put_contents($file, $content);
    return $file;
}

// Check if form data has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the attendance array is set in the POST data
    if (isset($_POST['attendance'])) {
        $absentees = array();
        // Loop through the attendance data to find absent students
        foreach ($_POST['attendance'] as $registerNo => $attendance) {
            if ($attendance == 'absent') {
                // Store absent student's name
                $absentees[$registerNo] = $students[$registerNo];
            }
        }
        // Generate absentees list file
        $file = generateAbsenteesFile($absentees);
        
        // Download file
        if (file_exists($file)) {
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename="' . basename($file) . '"');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($file));
            readfile($file);
            exit;
        }
    } else {
        echo "<p>No attendance data found.</p>";
    }
} else {
    echo "<p>No data submitted.</p>";
}
?>

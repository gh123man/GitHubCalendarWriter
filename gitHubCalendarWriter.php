<?php


$message = " Hi GitHub"; //caps works best
$commitWeight = 20;

drawOnGithub($message, $commitWeight);


function drawOnGithub($message, $weight) {

    $days = array(
        "Sunday"    => 0,
        "Monday"    => 1,
        "Tuesday"   => 2,
        "Wednesday" => 3,
        "Thursday"  => 4,
        "Friday"    => 5,
        "Saturday"  => 6,
    );

    $im = imagecreate(110, 7);
    imagecolorallocate($im, 0, 0, 0);
    $textColor = imagecolorallocate($im, 0xFF, 0xFF, 0xFF);
    imagestring($im, 1, 0, 0,  $message, $textColor);
    
    $oneDay = 60 * 60 * 24;

    $now = time();
    $exactlyOneYearAgo = $now - ($oneDay * 365);

    $dayOfTheWeekOneYearAgo = date('l', $exactlyOneYearAgo);

    $offsetDays = 7 - $days[$dayOfTheWeekOneYearAgo];
    
    $offsetDate = $exactlyOneYearAgo + ($offsetDays * $oneDay);
    
    $weekCount = 0;

    mkdir("messageRepo");
    chdir("messageRepo");
    
    exec('echo "generated with: https://github.com/gh123man/GitHubCalendarWriter" > README.md');

    exec("git init");

    $dayCount = $offsetDate;
    
    firstCommit($dayCount);

    for ($i = 0; $i < 110; $i++) {
        for ($j = 0; $j < 7; $j++) {
            $c = imagecolorat ($im, $i, $j);
            if ($c != 0) {
                for ($a = 0; $a < $weight; $a++) {
                    exec(commit($dayCount));
                }
            }
            $dayCount += $oneDay;
        }
    }
    
    imagedestroy($im);

}

function commit($time) {
    return "GIT_AUTHOR_DATE=$time GIT_COMMITTER_DATE=$time git commit --allow-empty --allow-empty-message -m ''";
}
function firstCommit($time) {
    exec("git add README.md");
    exec("GIT_AUTHOR_DATE=$time GIT_COMMITTER_DATE=$time git commit -m 'added README.md'");
}



?>

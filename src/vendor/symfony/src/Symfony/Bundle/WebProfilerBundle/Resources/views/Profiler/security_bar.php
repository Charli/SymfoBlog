<img style="margin: 0 5px 0 10px; vertical-align: middle; height: 24px" width="24" height="24" alt="Security" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAB8AAAAfCAYAAAAfrhY5AAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAftJREFUeNpi/P//P8NAASaGAQSjlg8IYEHmMDIyEqMnAYiDgZgHyv8CxGuBeAEhjeiJm4VExybEx8fX29vby3BwcID1/vjx48/Bgwd1Fi5cyECMA1A8i+waAj7nSUhIOOvi4qKGTXLPnj23FixYYAwNCaJ8TnSca2lpGVpaWir9/fuXARsGyYHU0CTBKSoqerOxsbH8+/ePARsGyYHUkJ3g8AFVVVWNP3/+EFRDE8tBvgMFLyE1NLGci4vrHSGfg9TQJM65ubl3gSzHh0FqaOJzTk7OHYR8DlJDE5+XlJR8ePfu3eHfv38zYMMgOZAampXtQJ/14QpykBypZTspJRwY1NXVYW19NDU1EdRMSdluAKpQ8MR7M7SCuUAtn4NqLhsgjldRUdEwNjaWkZOTE8Fm0KNHj96cPXv2yZ07d24AuaBa5gh6OY/uc1yWS4B8Ccy3vpqamvJASxWA2YiDGN98/fr1B9ARD65fv/7w27dvm6Gh8YIYy0E+bRYSErIA+VJZWVmClZWV1GoXDIA54M/du3dfgEIDmBNOAIVqgXZ9wWk5Pz9/iZubW7WoqKgANVssr1+//rBr167Wjx8/9uC03NHR8bGampoMLZpMt27derJ//35ZnKldSUlJhlApRi4AmY23eCW1VqJqA5JQlUltwDjaXRpxlgMEGAA2xSf2HpUp2wAAAABJRU5ErkJggg==" />
<?php if ($data->isAuthenticated()): ?>
    <span style="color: #3a3"><?php echo $data->getUser() ?></span>
<?php elseif ($data->isEnabled()): ?>
    <span style="color: #a33">anon.</span>
<?php else: ?>
    <span style="color: #a33">disabled</span>
<?php endif; ?>

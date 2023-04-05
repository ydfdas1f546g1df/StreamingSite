
<?php
$homeContent = '
<main class="agb-main">
<span class="page-title">Terms of use</span>
<span class="start-date">last change: 04.04.2023</span>
    <span class="agb-text">Welcome to StreamingSite! Please read these terms of service carefully before using our website. By accessing or using our website, you agree to be bound by these terms of service. If you do not agree to all the terms and conditions of this agreement, then you may not access the website or use any services.</span>
    <span class="agb-text"> We reserve the right to change these Terms of Use at any time. You should therefore check this page regularly for any changes.</span>
    <div class="agb-el">
        <span class="agb-title">§ 1 Intellectual Property Rights</span>
        <span class="agb-text">All content on the website, including but not limited to text, graphics, logos, images, videos, and software, is the property of the website or its content suppliers and is protected by copyright, trademark, and other intellectual property laws. You may not reproduce, modify, distribute, or otherwise use any of the content without our prior written permission.</span>
    </div>

    <div class="agb-el">
        <span class="agb-title">§ 2 User Accounts</span>
        <span class="agb-text"> To use certain features of the website, you may be required to create an account. You agree to provide accurate and complete information when creating an account and to keep your account information up to date. You are responsible for maintaining the confidentiality of your account and password and for restricting access to your computer or mobile device. You agree to accept responsibility for all activities that occur under your account.</span>
    </div>

    <div class="agb-el">
        <span class="agb-title">§ 3 User Conduct</span>
        <span class="agb-text">You agree not to use the website for any unlawful purpose or in any way that could damage, disable, overburden, or impair the website or interfere with any other party\'s use of the website. You agree not to use the website to distribute spam, chain letters, or other unsolicited communications. You agree not to access or attempt to access any part of the website that you are not authorized to access.</span>
    </div>

    <div class="agb-el">
        <span class="agb-title">§ 4 Content Submission</span>
        <span class="agb-text">You may submit content to the website, including but not limited to comments, reviews, and ratings. By submitting content, you grant us a non-exclusive, royalty-free, perpetual, irrevocable, and fully sublicensable right to use, reproduce, modify, adapt, publish, translate, create derivative works from, distribute, and display such content throughout the world in any media. You represent and warrant that you have all necessary rights to submit the content and that the content is not defamatory or infringing on any third \'s rights.</span>
    </div>

    <div class="agb-el">
        <span class="agb-title">§ 5 Disclaimer of Warranties</span>
        <span class="agb-text">  The website and its content are provided on an "as is" and "as available" basis without warranties of any kind, either express or implied. We do not warrant that the website will be uninterrupted or error-free, that defects will be corrected, or that the website or the server that makes it available are free of viruses or other harmful components.</span>
    </div>

    <div class="agb-el">
        <span class="agb-title">§ 6 Limitation of Liability</span>
        <span class="agb-text">To the maximum extent permitted by law, we shall not be liable for any direct, indirect, incidental, special, or consequential damages arising out of or in any way connected with the use of the website, including but not limited to damages for loss of profits, data, or other intangible losses, even if we have been advised of the possibility of such damages.</span>
    </div>

    <div class="agb-el">
        <span class="agb-title">§ 7 Indemnification</span>
        <span class="agb-text">You agree to indemnify, defend, and hold us harmless from and against any claims, liabilities, damages, losses, costs, or expenses arising out of or in any way connected with your use of the website or any content you submit to the website.</span>
    </div>

    <div class="agb-el">
        <span class="agb-title">§ 8 Termination</span>
        <span class="agb-text">We may terminate or suspend access to our website immediately, without prior notice or liability, for any reason whatsoever, including without limitation if you breach these terms of service. All provisions of these terms of service which by their nature should survive termination shall survive termination, including, without limitation, ownership provisions, warranty disclaimers, indemnity, and limitations of liability.</span>
    </div>

    <div class="agb-el">
        <span class="agb-title">§ 9 Governing Law</span>
        <span class="agb-text">These terms of service shall be governed by and construed in accordance with the laws of Gotham-City, without regard to its conflict of law provisions.</span>
    </div>
</main>
';

include '../.././template/index.php';

//$content = file_get_contents("https://127.69.69.69/api/check_user");


if (isset($cookie)) {
    if ($login) {
        if ($IsAdmin) {
            $Page = $adminHeader;
        } else {
            $Page = $loggedInHeader;
        }
    } else {
        $Page = $notLoggedInHeader;
    }
} else {
    $Page = $notLoggedInHeader;
}
$Page = $Page . $homeContent . $footer;
echo $Page;


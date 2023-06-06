<!DOCTYPE html>
<html class="min-vh-100">
<head>
<title><?= lang('common_rules'); ?></title>
    <?php $this->load->view('frontend/layout/head'); ?>
</head>
<body class="text-white text-break">
    <?php $this->load->view('frontend/layout/header'); ?>  
    <?php $this->load->view('frontend/layout/navbar'); ?>
    <div class="container">
        <h3 class="text-center text-warning mb-3"><?= lang('common_rules'); ?></h3>
        <div class="row">
            <div class="col-12"><h5 class="text-warning">Stud Report</h5></div>
        </div>
        <div class="row mb-5">
            <div class="col-12">
                <ul>
                    <li>Each applicant is required to become a member of the ICR and register a kennel by paying an annual fee.</li>
                    <li>The female and male dogs that is gonna be mated or bred must have an ICR certificate</li>
                    <li>Send photos of male's and female's dog certificate (back side) that is gonna be mated or bred through the ICRPedigree website</li>
                    <li>Send documentation in the form of mating photo according to the date of the breeding through the ICRPedigree website</li>
                </ul>
            </div>
        </div>
        <div class="row">
            <div class="col-12"><h5 class="text-warning">Birth Report</h5></div>
        </div>
        <div class="row mb-5">
            <div class="col-12">
                <ul>
                    <li>Reporting the date of birth, number, and gender of puppies through the ICRPedigree website</li>
                    <li>Send documentation in the form of photo of the mother breastfeeding their babies through the ICRPedigree website</li>
                    <li>The deadline for reporting birth is 75 days from the date of stud report.</li>
                    <li>The ICR has the right to refuse a birth application if the birth report exceeds the specified time limit.</li>
                </ul>
            </div>
        </div>
        <div class="row">
            <div class="col-12"><h5 class="text-warning">STAMBUM APPLICATION OF CHILDREN</h5></div>
        </div>
        <div class="row mb-5">
            <div class="col-12">
                <ul>
                    <li>Date of birth</li>
                    <li>Puppy's photo</li>
                    <li>Puppy's name</li>
                    <li>Names of the puppy's father and mother</li>
                    <li>Kennel name</li>
                    <li>Owner's name</li>
                    <li>The deadline for puppies registration is 100 days from the date of birth report.</li>
                    <li>If the submission for registration passes from the specified date (100 days from birth report date) then the puppy will be considered as first generation and will not have ancestry (F1), all submissions are registered through the ICRPedigree website</li>
                </ul>
                <br>
                <p><strong>NOTE</strong>: Each ICR member must fulfill the terms and conditions that have been given, the ICR has the right to cancel the application if one of the points above is not fulfilled.</p>
                <p>Terms and conditions may change at any time and will be informed through the ICRPedigree website</p>
            </div>
        </div>
        </div>
    <?php $this->load->view('frontend/layout/footer'); ?>
</body>
</html>
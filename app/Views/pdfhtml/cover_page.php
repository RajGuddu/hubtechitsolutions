<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Cover Page</title>
    <style>
    * {
        box-sizing: border-box;
    }

    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        color: #222;
    }

    .page-1 {
        width: 715px;
        height: 1020px;
        padding: 35px 55px 30px 55px;
    }

    .page-2 {
        width: 715px;
        min-height: 1000px;
        padding: 35px 55px 30px 55px;
    }

    h1,
    h2,
    h3 {
        text-align: center;
        margin-top: 10px;
        margin-bottom: 20px;
    }

    h2 {
        font-size: 22px;
    }

    p {
        line-height: 1.8;
        margin-top: 10px;
        margin-bottom: 15px;
        text-align: justify;
    }

    .center {
        text-align: center;
    }

    .red {
        color: red;
        font-weight: bold;
    }

    .line {
        border-bottom: 1px solid #000;
        display: inline-block;
        width: 200px;
        height: 16px;
    }

    .section {
        margin-top: 25px;
        margin-bottom: 20px;
    }

    .section p {
        text-align: center;
    }
</style>
</head>

<body>

    <!-- COVER PAGE -->
    <div class="page-1">
        <h2>INTERNSHIP PROJECT REPORT</h2>
        <h3>ON</h3>
        <h2 class="center red">“<?=ucwords($record->ic_name) ?>”</h2>
        <p class="center">
            Submitted in Partial Fulfillment of the Requirements<br>
            for the Award of the Degree of<br>
            <b>
                SEMESTER -
                <?= strtoupper(esc($record->semester)) ?>
            </b><br><br>

            <b>SESSION: </b>
            <?= esc($record->session) ?><br>
            <b>IN</b>

        </p>

        <p class="center">
            <b>
                <?= esc($record->class) ?> (<?=esc($record->sub_name)?>)
            </b>
        </p>

        <div class="section center">
            <p><b>SUBMITTED BY</b></p>

            Student Name: <b>
                <?= ucwords(esc($record->stu_name)) ?>
            </b><br><br>

            University Roll No.: <b>
                <?= esc($record->uni_roll_no) ?>
            </b><br><br>

            University Reg. No.: <b>
                <?= esc($record->uni_reg_no) ?>
            </b><br><br>

            College Application No.: <b>
                <?= esc($record->enroll_id) ?>
            </b>

        </div>

        <div class="section center">
            <p><b>SUBMITTED TO</b></p>

            <h2 style="color: green;">
                <?= strtoupper(esc($record->college_name)) ?>
            </h2>

            <p>
                (Permanently Affiliated to
                Veer Kunwar Singh University Ara)
            </p>

        </div>

        <div class="section">
            <p><b>UNDER THE GUIDANCE OF</b></p>

            Guide Name: <span class="line"></span><br><br>
            Designation: <span class="line"></span>

        </div>

        <p>
            <b>Month & Year of Submission: <span class="line"></span></b>
        </p>
    </div>


    <!-- DECLARATION PAGE -->
    <div class="page-2">

        <h2>DECLARATION</h2>

        <p>
            I hereby declare that the project work entitled
            <span class="red">“
                <?= ucwords(esc($record->ic_name)) ?>”
            </span>
            is my original work, carried out in partial fulfillment of the requirements
            for the
            SEMESTER -
            <?= strtoupper(esc($record->semester)) ?>
            (Session:
            <?= esc($record->session) ?>).
        </p>

        <p>
            The project has been completed under the guidance and supervision of the
            concerned project guide. The work presented in this report is based on my
            study, research, observations, and efforts carried out during the project
            period.
        </p>

        <p>
            I further declare that this project report has not been submitted previously,
            either in whole or in part, to any institution or university for the award of
            any degree, diploma, certificate, or any other academic qualification.
            To the best of my knowledge, the work presented in this report is original.
        </p>

        <p>
            Date: <span class="line"></span><br><br>

            Student Name: <b>
                <?= ucwords(esc($record->stu_name)) ?>
            </b><br>

            University Roll No.:
            <b>
                <?= esc($record->uni_roll_no) ?>
            </b><br>

            University Registration No.:
            <b>
                <?= esc($record->uni_reg_no) ?>
            </b><br>

            Session:
            <?= esc($record->session) ?>

        </p>

        <br>

        <p>
            __________________________<br>
            Signature of the Student
        </p>

    <!-- </div> -->

    <!-- ACKNOWLEDGEMENT PAGE -->
    <!-- <div class="page"> -->
        <h2>ACKNOWLEDGEMENT</h2>

        <p>
            I would like to express my sincere gratitude to my Project Guide and all
            the teachers for their valuable guidance, constructive suggestions, and
            continuous encouragement throughout the completion of this project.
        </p>

        <p>
            I am deeply thankful to the management and faculty members of the institution
            for providing me with the necessary support, resources, and academic
            environment required to successfully complete this project.
        </p>

        <p>
            I also extend my sincere thanks to all those individuals who directly or
            indirectly supported me during the collection of information, preparation,
            development, and documentation of this project report.
        </p>

        <p>
            Finally, I express my heartfelt gratitude to my parents and family members
            for their constant motivation, patience, encouragement, and unconditional
            support throughout my academic journey.
        </p>

        <br>

        <p class="center">
            __________________________________<br>
            Signature of the Student
        </p>

    </div>

</body>

</html>
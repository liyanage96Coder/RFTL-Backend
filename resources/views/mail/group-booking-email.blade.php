<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>

    <link rel="icon" href="https://rftl.com/assets/images/favicon.svg"/>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,400;1,500&display=swap"
        rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">

    <title>Run For Their Lives</title>

    <style>
        *, ::after, ::before {
            box-sizing: border-box;
        }

        header {
            padding: 5% 0;
        }

        header > .container {
            text-align: center;
        }

        body {
            padding: 5% 0;
            font-family: 'Inter', sans-serif;
        }

        .container {
            width: 100%;
            padding-right: 15px;
            padding-left: 15px;
            margin-right: auto;
            margin-left: auto;
        }

        #body {
            margin-bottom: 2%;
        }

        h1, h2, h3, h4, h5, h6 {
            margin-bottom: .5rem;
            font-weight: 500;
            line-height: 1.2;
            color: #0D0D0D;
            font-family: 'Montserrat', sans-serif;
        }

        h1, h2, h3, h4, h5, h6 {
            margin-top: 0;
            margin-bottom: .5rem;
        }

        h1 {
            font-size: 28px;
            font-weight: 700;
            line-height: 14px;
            margin-bottom: 2rem;
        }

        h2 {
            font-size: 24px;
            font-weight: 700;
            line-height: 14px;
        }

        p {
            color: #333333;
        }

        a {
            color: #333333;
        }

        .light-background {
            background-color: #FBFBFB;
            padding: 5% 0;
        }

        .bold {
            font-weight: bold;
        }

        .text-uppercase {
            text-transform: uppercase;
        }

        .text-underline {
            text-decoration: underline;
        }

        .purple-background {
            background-color: #F8EDFF;
            text-align: center;
        }

        .container > .purple-background {
            padding: 5% 15%;
        }

        .container > .light-background {
            padding: 5%;
        }

        .purple-font {
            color: #A83FE5;
        }

        .dark-purple-background {
            background-color: #F4E6FC;
            padding: 2%;
            border-radius: 4px;
            margin-bottom: 24px;
        }

        .dark-purple-background > p {
            margin: 0;
        }

        .personDetail .lineSingle {
            display: flex;
            flex-direction: row;
            align-items: flex-start;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .personDetail .lineSingle span {
            display: block;
        }

        .personDetail .lineSingle span:first-child {
            color: #393939;
            font-family: 'Inter', sans-serif;
            font-size: 13px;
            font-style: normal;
            font-weight: 400;
            line-height: 14px; /* 107.692% */
        }

        .personDetail .lineSingle span:last-child {
            color: #383838;
            text-align: right;
            font-family: 'Inter', sans-serif;
            font-size: 13px;
            font-style: normal;
            font-weight: 700;
            line-height: 14px; /* 107.692% */
        }

        .personDetail .lineSingle:last-child {
            padding-bottom: 24px;
            border-bottom: 2px solid #E7E7E7;
            margin-bottom: 24px;
        }

        .tSize .lineSingle {
            display: flex;
            flex-direction: row;
            align-items: flex-start;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .tSize .lineSingle span {
            display: block;
        }

        .tSize .lineSingle span:first-child {
            color: #7D7D7D;
            font-family: 'Inter', sans-serif;
            font-size: 14px;
            font-style: normal;
            font-weight: 500;
            line-height: 14px; /* 100% */
        }

        .tSize .lineSingle span:last-child {
            color: #383838;
            text-align: right;
            font-family: 'Inter', sans-serif;
            font-size: 13px;
            font-style: normal;
            font-weight: 600;
            line-height: 14px; /* 107.692% */
        }

        .tSize .lineSingle:last-child {
            padding-bottom: 24px;
            border-bottom: 2px solid #E7E7E7;
            margin-bottom: 24px;
        }

        .registData .lineSingle {
            display: flex;
            flex-direction: row;
            align-items: flex-start;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .registData .lineSingle span {
            display: block;
        }

        .registData .lineSingle span:first-child {
            color: #7D7D7D;
            font-family: 'Inter', sans-serif;
            font-size: 14px;
            font-style: normal;
            font-weight: 600;
            line-height: 14px; /* 100% */
        }

        .registData .lineSingle span:last-child {
            color: #383838;
            text-align: right;
            font-family: 'Inter', sans-serif;
            font-size: 13px;
            font-style: normal;
            font-weight: 600;
            line-height: 14px; /* 107.692% */
        }

        .registData .lineSingle:last-child {
            padding-bottom: 24px;
            border-bottom: 2px solid #E7E7E7;
            margin-bottom: 24px;
        }

        .totDonation .lineSingle {
            display: flex;
            flex-direction: row;
            align-items: flex-start;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .totDonation .lineSingle span {
            display: block;
        }

        .totDonation .lineSingle span:first-child {
            color: #E53F71;
            font-family: 'Inter', sans-serif;
            font-size: 18px;
            font-style: normal;
            font-weight: 600;
            line-height: 14px; /* 77.778% */
        }

        .totDonation .lineSingle span:last-child {
            color: #E54E7B;
            text-align: center;
            font-family: 'Inter', sans-serif;
            font-size: 18px;
            font-style: normal;
            font-weight: 700;
            line-height: 14px; /* 77.778% */
        }

        .tLableTxt {
            display: flex;
            padding: 20px 24px;
            align-items: flex-start;
            gap: 10px;
            align-self: stretch;
            border-radius: 4px;
            background-color: rgba(168, 63, 229, 0.285);
            margin-bottom: 20px;
        }

        .tLableTxt span {
            color: #A83FE5;
            text-align: center;
            font-family: 'Inter', sans-serif;
            font-size: 16px;
            font-style: normal;
            font-weight: 600;
            line-height: 14px; /* 87.5% */
            text-transform: capitalize;
        }

        .grpCat .lineSingle span:first-child {
            color: #7D7D7D;
            font-family: 'Inter', sans-serif;
            font-size: 14px;
            font-style: normal;
            font-weight: 500;
            line-height: 14px; /* 100% */
        }

        .grpCat .lineSingle span:last-child {
            color: #383838;
            text-align: right;
            font-family: 'Inter', sans-serif;
            font-size: 13px;
            font-style: normal;
            font-weight: 600;
            line-height: 14px; /* 107.692% */
        }

        .quntiLbl .lineSingle span:first-child {
            color: #7D7D7D;
            font-family: 'Inter', sans-serif;
            font-size: 14px;
            font-style: normal;
            font-weight: 500;
            line-height: 14px; /* 100% */
        }

        .quntiLbl .lineSingle span:last-child {
            color: #7D7D7D;
            text-align: right;
            font-family: 'Inter', sans-serif;
            font-size: 14px;
            font-style: normal;
            font-weight: 500;
            line-height: 14px; /* 100% */
        }

        .tDatalbls .lineSingle span:first-child {
            color: #383838;
            font-family: 'Inter', sans-serif;
            font-size: 13px;
            font-style: normal;
            font-weight: 600;
            line-height: 14px; /* 107.692% */
        }

        .tDatalbls .lineSingle span:last-child {
            color: #383838;
            font-family: 'Inter', sans-serif;
            font-size: 13px;
            font-style: normal;
            font-weight: 600;
            line-height: 14px; /* 107.692% */
        }

        .donGrp .lineSingle span:first-child {
            color: #A83FE5;
            text-align: right;
            font-family: 'Inter', sans-serif;
            font-size: 18px;
            font-style: normal;
            font-weight: 600;
            line-height: 14px; /* 77.778% */
        }

        .donGrp .lineSingle span:last-child {
            color: #A83FE5;
            text-align: right;
            font-family: 'Inter', sans-serif;
            font-size: 18px;
            font-style: normal;
            font-weight: 700;
            line-height: 14px; /* 77.778% */
        }

        @media (min-width: 576px) {
            .container {
                max-width: 540px;
            }
        }

        @media (min-width: 768px) {
            body {
                padding: 5% 0;
            }

            .container {
                max-width: 720px;
                padding: 0;
            }
        }

        @media (min-width: 992px) {
            .container {
                max-width: 960px;
            }
        }

        @media (min-width: 1200px) {
            .container {
                max-width: 75%;
            }
        }

        @media (max-width: 576px) {
            h1 {
                font-size: 1.5rem;
            }

            body {
                font-size: 14px;
                padding: 0;
            }

            .logo {
                width: 50%;
            }
        }
    </style>
</head>
<body>
<header>
    <div class="container">
        <img src="https://rftl.com/assets/images/logo.png" alt="Logo" class="logo"/>
    </div>
</header>
<div id="body">
    <div class="container">
        <div class="purple-background">
            <h1>Your Booking is Confirmed!</h1>
            <p>
                {{ $booking->full_name }}, thank you for registering for Run For Their Lives 2024 in
                aid of the Apeksha Cancer Hospital. Please note that all the proceeds from the event will be donated to
                the Apeksha Cancer Hospital in Maharagama
            </p>
            <p>
                <strong>
                    Please make sure you have the receipt on hand when receiving the T-shirt at the event.
                </strong>
            </p>
        </div>
        <div class="light-background">
            <div class="tSize">
                <div class="lineSingle">
                    <span class="lineRow-person">{{ $booking->created_at->format('F d, Y') }}</span>
                    <span class="lineRow-person">Booking ID : {{ $booking->reference }}</span>
                </div>
                <div class="lineSingle">
                    <h2 class="lineRow-person">Billing Summary</h2>
                </div>
            </div>
            <div class="personDetail">
                <div class="lineSingle">
                    <span class="lineRow-person">Organization / Company / Group Name :</span>
                    <span class="lineRow-person">{{ $booking->full_name }}</span>
                </div>
                <div class="lineSingle">
                    <span class="lineRow-person">Name of Contact Person :</span>
                    <span class="lineRow-person">{{ $booking->person_name }}</span>
                </div>
                <div class="lineSingle">
                    <span class="lineRow-person">Contact Number :</span>
                    <span class="lineRow-person">{{ $booking->phone }}</span>
                </div>
                <div class="lineSingle">
                    <span class="lineRow-person">Email Address :</span>
                    <span class="lineRow-person">{{ $booking->email }}</span>
                </div>
            </div>

            <div class="tSize">
                <div class="lineSingle">
                    <span class="lineRow-person">Group Category</span>
                    <span class="lineRow-person" style="font-weight: normal">Payment Method</span>
                </div>
                <div class="lineSingle">
                    <span
                        class="lineRow-person"
                        style="font-weight: bold; color: #383838">{{ $booking->group_category }}</span>
                    <span class="lineRow-person"
                          style="font-weight: bold; color: #383838">{{ $booking->payment_type }}</span>
                </div>
            </div>

            <div class="dark-purple-background">
                <p class="purple-font"><strong>T-Shirt Size Details</strong></p>
            </div>

            <div class="registData tDatalbls">
                @foreach ($booking->bookingTShirts as $bookingTShirt)
                <div class="lineSingle">
                    <span
                        class="lineRow-person">{{ $bookingTShirt->t_shirt_id ? $bookingTShirt->tShirt->description. " (".$bookingTShirt->tShirt->size. ")" : "No T-Shirt" }} :</span>
                    <span class="lineRow-person">{{ sprintf("%02d", $bookingTShirt->quantity) }}</span>
                </div>
                @endforeach
            </div>

            <div class="personDetail">
                <div class="lineSingle">
                    <span class="lineRow-person">Total T-Shirt Quantity :</span>
                    <span
                        class="lineRow-person">{{ sprintf("%02d", $booking->member_count) }}</span>
                </div>
            </div>

            <div class="registData">
                <div class="lineSingle">
                    <span class="lineRow-person">Registration Fee :</span>
                    <span class="lineRow-person">LKR {{ $booking->member_count * 1400 }}</span>
                </div>
                <div class="lineSingle">
                    <span class="lineRow-person">Extra Donation :</span>
                    <span class="lineRow-person">LKR {{ $booking->donation - ($booking->member_count * 1400) }}</span>
                </div>
            </div>

            <div class="totDonation donGrp">
                <div class="lineSingle">
                    <span class="lineRow-person">Donation Amount :</span>
                    <span class="lineRow-person">LKR {{ $booking->donation }}</span>
                </div>
            </div>

            <div class="personDetail">
                <div class="lineSingle" style="border-top: 2px solid #E7E7E7; padding-top: 24px">
                    <span class="lineRow-person" style="width: 50%">
                        <strong>
                            Scan the QR Code to confirm your participation in the annual RFTL Charity Run - 2024.
                        </strong>
                        <br/><br/>
                        This is for one time use only and is non-transferrable. Please note that in the event of loss or
                        misplacement of receipt, you will be denied entry to the event.
                    </span>
                    <span class="lineRow-person">
                        {!! QrCode::size(80)->generate('https://rftl.com/booking/' . base64_encode($booking->reference)) !!}
                    </span>
                </div>
            </div>
            <p>
                If you have any questions or inquiries, please don’t hesitate to contact us via email
                (rftl.charityrun@gmail.com) or contact number (+94) 76 232 8714.
            </p>
            <br/>
            <p>
                <strong>Thank you for your contributions</strong><br/>
                Rotaract Club Colombo Uptown (RCCU)
            </p>
        </div>
    </div>
</body>
</html>

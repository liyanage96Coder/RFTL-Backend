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

        .dark-purple-background {
            background-color: #F4E6FC;
            padding: 2%;
            border-radius: 4px;
            margin-bottom: 24px;
        }

        .purple-font {
            color: #A83FE5;
        }

        .d-flex {
            display: flex;
            flex-direction: row;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 20px;
            width: 100%;
        }

        .d-flex > div {
            color: #393939;
            font-family: 'Inter', sans-serif;
            font-size: 13px;
            font-style: normal;
            font-weight: 400;
            line-height: 14px; /* 107.692% */
            width: 50%;
        }

        .d-flex > div.last-div {
            color: #383838;
            text-align: right;
            font-family: 'Inter', sans-serif;
            font-size: 13px;
            font-style: normal;
            font-weight: 700;
            line-height: 14px; /* 107.692% */
        }

        .d-flex > div.booking-id {
            font-family: 'Inter', sans-serif;
            font-weight: 500;
        }

        .total-donation > div > div, .total-donation > div > div.last-div {
            color: #A83FE5;
            font-family: 'Inter', sans-serif;
            font-size: 18px;
            font-style: normal;
            font-weight: 600;
            line-height: 14px; /* 77.778% */
        }

        .border-bottom {
            border-bottom: 2px solid #D7D7D7;
            padding-top: 24px;
            margin-top: 24px;
            padding-bottom: 24px;
            margin-bottom: 24px;
        }

        .qr-text {
            width: 50%;
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
                line-height: 1.2;
            }

            body {
                font-size: 14px;
                padding: 0;
            }

            .logo {
                width: 50%;
            }

            .qr-text {
                width: 100%;
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
            <div class="border-bottom">
                <div class="d-flex">
                    <div>{{ $booking->created_at->format('F d, Y') }}</div>
                    <div class="last-div booking-id">Booking ID : {{ $booking->reference }}</div>
                </div>
                <div>
                    <h2 class="lineRow-person">Billing Summary</h2>
                </div>
            </div>
            <div class="border-bottom">
                <div class="d-flex">
                    <div>Organization / Company / Group Name :</div>
                    <div class="last-div">{{ $booking->full_name }}</div>
                </div>
                <div class="d-flex">
                    <div>Name of Contact Person :</div>
                    <div class="last-div">{{ $booking->person_name }}</div>
                </div>
                <div class="d-flex">
                    <div>Contact Number :</div>
                    <div class="last-div">{{ $booking->phone }}</div>
                </div>
                <div class="d-flex">
                    <div>Email Address :</div>
                    <div class="last-div">{{ $booking->email }}</div>
                </div>
            </div>

            <div class="border-bottom">
                <div class="d-flex">
                    <div>Group Category</div>
                    <div class="last-div" style="font-weight: normal">Payment Method</div>
                </div>
                <div class="d-flex">
                    <div style="font-weight: bold; color: #383838">
                        {{ $booking->group_category }}
                    </div>
                    <div class="last-div" style="font-weight: bold; color: #383838">
                        {{ $booking->payment_type }}
                    </div>
                </div>
            </div>

            <div class="dark-purple-background">
                <p class="purple-font"><strong>T-Shirt Size Details</strong></p>
            </div>

            <div>
                @foreach ($booking->bookingTShirts as $bookingTShirt)
                <div class="border-bottom">
                    <div class="d-flex">
                        <div>
                            {{ $bookingTShirt->t_shirt_id ? $bookingTShirt->tShirt->description. " (".$bookingTShirt->tShirt->size. ")" : "No T-Shirt"
                            }} :
                        </div>
                        <div class="last-div">{{ sprintf("%02d", $bookingTShirt->quantity) }}</div>
                    </div>
                </div>
                @endforeach
            </div>

            <div class="border-bottom">
                <div class="d-flex">
                    <div>Total T-Shirt Quantity :</div>
                    <div class="last-div">{{ sprintf("%02d", $booking->member_count) }}</div>
                </div>
            </div>

            <div class="border-bottom">
                <div class="d-flex">
                    <div>Registration Fee :</div>
                    <div class="last-div">LKR {{ $booking->member_count * 1600 }}</div>
                </div>
                <div class="d-flex">
                    <div>Extra Donation :</div>
                    <div class="last-div">LKR {{ $booking->donation - ($booking->member_count * 1600) }}</div>
                </div>
            </div>

            <div class="border-bottom total-donation">
                <div class="d-flex">
                    <div>Donation Amount :</div>
                    <div class="last-div">LKR {{ $booking->donation }}</div>
                </div>
            </div>
            <div class="border-bottom">
                <div class="d-flex">
                    <div class="qr-text">
                        <strong>
                            Scan the QR Code to confirm your participation in the annual RFTL Charity Run - 2024.
                        </strong>
                        <br/><br/>
                        This is for one time use only and is non-transferrable. Please note that in the event of loss or
                        misplacement of receipt, you will be denied entry to the event.
                    </div>
                    <div class="last-div">
                        @php
                        $booking_link = 'https://rftl.com/booking/' . base64_encode($booking->reference);
                        @endphp
                        <img
                            src="{!!$message->embedData(QrCode::format('png')->generate($booking_link), 'QrCode.png', 'image/png')!!}">
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
    </div>
</div>
</body>
</html>

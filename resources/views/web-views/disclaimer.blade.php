@extends('layouts.front-end.app')

@section('title',\App\CPU\translate('Privacy policy'))

@push('css_or_js')
    <meta property="og:image" content="{{asset('storage/app/public/company')}}/{{$web_config['web_logo']->value}}"/>
    <meta property="og:title" content="Terms & conditions of {{$web_config['name']->value}} "/>
    <meta property="og:url" content="{{env('APP_URL')}}">
    <meta property="og:description" content="{!! substr($web_config['about']->value,0,100) !!}">

    <meta property="twitter:card" content="{{asset('storage/app/public/company')}}/{{$web_config['web_logo']->value}}"/>
    <meta property="twitter:title" content="Terms & conditions of {{$web_config['name']->value}}"/>
    <meta property="twitter:url" content="{{env('APP_URL')}}">
    <meta property="twitter:description" content="{!! substr($web_config['about']->value,0,100) !!}">

    <style>
        .headerTitle {
            font-size: 25px;
            font-weight: 700;
            margin-top: 2rem;
        }

        .for-container {
            width: 91%;
            border: 1px solid #D8D8D8;
            margin-top: 3%;
            margin-bottom: 3%;
        }

        .for-padding {
            padding: 3%;
        }
    </style>
@endpush

@section('content')
    <div class="container rounded for-container rtl" style="text-align: {{Session::get('direction') === "rtl" ? 'right' : 'left'}};">
        {{-- <h2 class="text-center mt-3 headerTitle">{{\App\CPU\translate('Privacy policy')}}</h2> --}}
        <div class="for-padding">
            {{-- {!! $privacy_policy['value'] !!} --}}


            <h1 class="text-center"><b>Disclaimer</b></h1>
            <h3>
               <b> Interpretation and Definitions </b>
            </h3>

            <h2>Interpretation</h2>

            The words of which the initial letter is capitalized have meanings defined under the following conditions. The following definitions shall have the same meaning regardless of whether they appear in singular or in plural.<br><br>

           <h3><b>Definitions</b></h3>
            For the purposes of this Disclaimer:<br>

            Company (referred to as either "the Company", "We", "Us" or "Our" in this Disclaimer) refers to Nillgiri Online Shopping Mall, Level-01, Block-D, Shop-73, Farmgate, Dhaka..<br><br>
            Service refers to the Website.
            You means the individual accessing the Service, or the company, or other legal entity on behalf of which such individual is accessing or using the Service, as applicable.
            Website refers to nillgiri, accessible from https://www.nillgiri.com/ <br><br>

            <h3><b>Disclaimer</b></h3><br>
            The information contained on the Service is for general information purposes only.
            The Company assumes no responsibility for errors or omissions in the contents of the Service.
            In no event shall the Company be liable for any special, direct, indirect, consequential, or incidental damages or any damages whatsoever, whether in an action of contract, negligence or other tort, arising out of or in connection with the use of the Service or the contents of the Service. The Company reserves the right to make additions, deletions, or modifications to the contents on the Service at any time without prior notice. This Disclaimer has been created with the help of the Free Disclaimer Generator.
            The Company does not warrant that the Service is free of viruses or other harmful components.<br><br>

            <br><h3><b>External Links Disclaimer</b></h3>

            The Service may contain links to external websites that are not provided or maintained by or in any way affiliated with the Company.
            Please note that the Company does not guarantee the accuracy, relevance, timeliness, or completeness of any information on these external websites.
            <br><br><h3><b>Errors and Omissions Disclaimer</b></h3>
            The information given by the Service is for general guidance on matters of interest only. Even if the Company takes every precaution to insure that the content of the Service is both current and accurate, errors can occur. Plus, given the changing nature of laws, rules and regulations, there may be delays, omissions or inaccuracies in the information contained on the Service.
            The Company is not responsible for any errors or omissions, or for the results obtained from the use of this information.
            <br> <br><h3><b>Fair Use Disclaimer</b></h3>
            The Company may use copyrighted material which has not always been specifically authorized by the copyright owner. The Company is making such material available for criticism, comment, news reporting, teaching, scholarship, or research.
            The Company believes this constitutes a "fair use" of any such copyrighted material as provided for in section 107 of the United States Copyright law.
            If You wish to use copyrighted material from the Service for your own purposes that go beyond fair use, You must obtain permission from the copyright owner.
            <br> <br><h3><b> Views Expressed Disclaimer</b></h3>
            The Service may contain views and opinions which are those of the authors and do not necessarily reflect the official policy or position of any other author, agency, organization, employer or company, including the Company.
            Comments published by users are their sole responsibility and the users will take full responsibility, liability and blame for any libel or litigation that results from something written in or as a direct result of something written in a comment. The Company is not liable for any comment published by users and reserves the right to delete any comment for any reason whatsoever.
            <br><br><h3><b>No Responsibility Disclaimer</b></h3>
            The information on the Service is provided with the understanding that the Company is not herein engaged in rendering legal, accounting, tax, or other professional advice and services. As such, it should not be used as a substitute for consultation with professional accounting, tax, legal or other competent advisers.
            In no event shall the Company or its suppliers be liable for any special, incidental, indirect, or consequential damages whatsoever arising out of or in connection with your access or use or inability to access or use the Service.
            <br><h3><b>"Use at Your Own Risk" Disclaimer</b></h3>
            All information in the Service is provided "as is", with no guarantee of completeness, accuracy, timeliness or of the results obtained from the use of this information, and without warranty of any kind, express or implied, including, but not limited to warranties of performance, merchantability and fitness for a particular purpose.
            The Company will not be liable to You or anyone else for any decision made or action taken in reliance on the information given by the Service or for any consequential, special or similar damages, even if advised of the possibility of such damages.
            <br><br><h3><b>Contact Us</b></h3>
            If you have any questions about this Disclaimer, You can contact Us:
            By visiting this page on our website: https://www.nillgiri.com/




        </div>
    </div>
@endsection

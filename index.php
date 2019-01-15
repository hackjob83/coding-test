<?php
/**
********************************************************************************
Author: John Hackett
Description: Main page for Synergy Marketing Partners code test. Displays
images and form along with front-end validation with Parsley and canvas
signature block rendering by szimek/signature_pad
(https://github.com/szimek/signature_pad_)
custom js scripts included at bottom
********************************************************************************
**/


require_once 'head.php'; ?>

  </head>
  <body>

    <div class="container">

      <!-- header row including Nissan logo and event title -->
    	<div class="row" id="header">
        <div class="col-3 nissan-logo"><img src="assets/img/nissan-logo.png" alt="Nissan Innovation that Excites" /></div>
        <div class="col-9 nissan-title">
          <h2 class="right"><strong>Nissan Intelligent Mobility Tour</strong></h2>
          <h4 class="right gray"><strong>Fillmore Jazz Festival</strong></h4>
        </div>
      </div>

      <!-- hero image -->
      <div class="" id="hero-img">
        <img src="assets/img/header.png" alt="Experience tomorrow's technology today behind the wheel of an all-new Nissan" class="img-fluid" />
      </div>

      <!-- form -->
      <div class="" id="form-container">
        <form name="reg_form" id="reg_form" action="process.php" method="post" enctype="multipart/form-data" data-parsley-errors-messages-disabled>
          <!-- basic info -->
          <div class="row">
            <div class="col-md-6 form-group spec-left">
              <label for="fname"><a data-toggle="tooltip" data-placement="top" title=" * Required"> * </a>First Name </label><input type="text" name="fname" id="fname" class="form-control" required data-parsley-length="[2, 30]" />
            </div>
            <div class="col-md-6 form-group spec-right">
              <label for="lname"><a data-toggle="tooltip" data-placement="top" title=" * Required"> * </a>Last Name </label><input type="text" name="lname" id="lname" class="form-control" required data-parsley-length="[2, 30]" />
            </div>
          </div>

          <div class="row">
            <div class="col-md-8 form-group spec-left">
              <label for="address"><a data-toggle="tooltip" data-placement="top" title=" * Required"> * </a>Address </label><input type="text" name="address" id="address" class="form-control" required data-parsley-length="[5, 60]"/>
            </div>
            <div class="col-md-4 form-group spec-right">
              <label for="apt">Apt/Suite </label><input type="text" name="apt" id="apt" class="form-control" />
            </div>
          </div>

          <div class="row">
            <div class="col-md-6 form-group spec-left">
              <label for="city"><a data-toggle="tooltip" data-placement="top" title=" * Required"> * </a>City </label><input type="text" name="city" id="city" class="form-control" required data-parsley-length="[2, 30]" />
            </div>
            <div class="col-md-3 form-group spec-left spec-right">
              <label for="state"><a data-toggle="tooltip" data-placement="top" title=" * Required"> * </a>State </label>
              <select name="state" id="state" class="form-control" required >
                <option value="">Select</option>
                <option value="AL">Alabama</option>
                <option value="AK">Alaska</option>
                <option value="AZ">Arizona</option>
                <option value="AR">Arkansas</option>
                <option value="CA">California</option>
                <option value="CO">Colorado</option>
                <option value="CT">Connecticut</option>
                <option value="DC">District of Columbia</option>
                <option value="DE">Delaware</option>
                <option value="FL">Florida</option>
                <option value="GA">Georgia</option>
                <option value="HI">Hawaii</option>
                <option value="ID">Idaho</option>
                <option value="IL">Illinois</option>
                <option value="IN">Indiana</option>
                <option value="IA">Iowa</option>
                <option value="KS">Kansas</option>
                <option value="KY">Kentucky</option>
                <option value="LA">Louisiana</option>
                <option value="ME">Maine</option>
                <option value="MD">Maryland</option>
                <option value="MA">Massachusetts</option>
                <option value="MI">Michigan</option>
                <option value="MN">Minnesota</option>
                <option value="MS">Mississippi</option>
                <option value="MO">Missouri</option>
                <option value="MT">Montana</option>
                <option value="NE">Nebraska</option>
                <option value="NV">Nevada</option>
                <option value="NH">New Hampshire</option>
                <option value="NJ">New Jersey</option>
                <option value="NM">New Mexico</option>
                <option value="NY">New York</option>
                <option value="NC">North Carolina</option>
                <option value="ND">North Dakota</option>
                <option value="OH">Ohio</option>
                <option value="OK">Oklahoma</option>
                <option value="OR">Oregon</option>
                <option value="PA">Pennsylvania</option>
                <option value="RI">Rhode Island</option>
                <option value="SC">South Carolina</option>
                <option value="SD">South Dakota</option>
                <option value="TN">Tennessee</option>
                <option value="TX">Texas</option>
                <option value="UT">Utah</option>
                <option value="VT">Vermont</option>
                <option value="VA">Virginia</option>
                <option value="WA">Washington</option>
                <option value="WV">West Virginia</option>
                <option value="WI">Wisconsin</option>
                <option value="WY">Wyoming</option>
              </select>
            </div>
            <div class="col-md-3 form-group spec-right">
              <label for="zip"><a data-toggle="tooltip" data-placement="top" title=" * Required"> * </a>Zip </label><input type="text" name="zip" id="zip" class="form-control" maxlength=5 required data-parsley-type="digits" />
            </div>
          </div>

          <div class="row">
            <div class="col-md-6 form-group spec-left">
              <label for="email"><a data-toggle="tooltip" data-placement="top" title=" * Required"> * </a>Email </label><input type="email" name="email" id="email" class="form-control" required data-parsley-type='email' />
            </div>
            <div class="col-md-6 form-group spec-right">
              <label for="c_email"><a data-toggle="tooltip" data-placement="top" title=" * Required"> * </a>Email Confirmation </label><input type="email" name="c_email" id="c_email" class="form-control" required data-parsley-type='email' data-parsley-equalto='#email' />
            </div>
          </div>

          <!-- q/a section of form -->
          <div class="row reverse-margin">

              <div class="col-md-6 reverse-padding spec-left form-group">
                <div class="q-box">
                <a data-toggle="tooltip" data-placement="top" title=" * Required"> * </a>I plan on purchasing my next vehicle within<br /><br />
                <p class="padded">
                  <input class="form-check-input" type="radio" name="q1" id="q1_a" value="1 Month" required />
                  <label class="form-check-label" for="q1_a">1 Month</label><br />
                  <input class="form-check-input" type="radio" name="q1" id="q1_b" value="1-3 Months" />
                  <label class="form-check-label" for="q1_b">1-3 Months</label><br />
                  <input class="form-check-input" type="radio" name="q1" id="q1_c" value="4-6 Months" />
                  <label class="form-check-label" for="q1_c">4-6 Months</label><br />
                  <input class="form-check-input" type="radio" name="q1" id="q1_d" value="7-12 Months" />
                  <label class="form-check-label" for="q1_d">7-12 Months</label><br />
                  <input class="form-check-input" type="radio" name="q1" id="q1_e" value="More than 1 Year" />
                  <label class="form-check-label" for="q1_e">More than 1 Year</label>
                </p>
                </div>
              </div>

              <div class="col-md-6 reverse-padding spec-right form-group">
                <div class=" q-box">
                <a data-toggle="tooltip" data-placement="top" title=" * Required"> * </a>I am interested in the following vehicles<br /><br />
                <p class="padded">
                  <input class="form-check-input" type="checkbox" name="q2[]" id="q2_a" value="LEAF" data-parsley-mincheck="1" required />
                  <label class="form-check-label" for="q2_a">LEAF</label><br />
                  <input class="form-check-input" type="checkbox" name="q2[]" id="q2_b" value="Kicks" />
                  <label class="form-check-label" for="q2_b">Kicks</label><br />
                  <input class="form-check-input" type="checkbox" name="q2[]" id="q2_c" value="Rogue Sport" />
                  <label class="form-check-label" for="q2_c">Rogue Sport</label><br />
                  <input class="form-check-input" type="checkbox" name="q2[]" id="q2_d" value="Rogue" />
                  <label class="form-check-label" for="q2_d">Rogue</label>
                </p>
                </div>
              </div>
          </div>

          <div class="row reverse-margin">
            <div class="col-md-12 q-box form-group">
              <a data-toggle="tooltip" data-placement="top" title=" * Required"> * </a>How likely would you be to consider Nissan for your next new vehicle purchase?<br /><br />
              <p class="padded">
                <input class="form-check-input" type="radio" name="q3" id="q3_a" value="Definitely would consider" required />
                <label class="form-check-label" for="q3_a">Definitely would consider</label><br />
                <input class="form-check-input" type="radio" name="q3" id="q3_b" value="Probably would consider" />
                <label class="form-check-label" for="q3_b">Probably would consider</label><br />
                <input class="form-check-input" type="radio" name="q3" id="q3_c" value="Might or might not consider" />
                <label class="form-check-label" for="q3_c">Might or might not consider</label><br />
                <input class="form-check-input" type="radio" name="q3" id="q3_d" value="Probably would not consider" />
                <label class="form-check-label" for="q3_d">Probably would not consider</label><br />
                <input class="form-check-input" type="radio" name="q3" id="q3_e" value="Definitely would not consider" />
                <label class="form-check-label" for="q3_e">Definitely would not consider</label>
              </p>
            </div>
          </div>

          <div class="row reverse-margin">
            <div class="col-md-12 q-box form-group">
              <a data-toggle="tooltip" data-placement="top" title=" * Required"> * </a>What is your overall opinion of Nissan?<br /><br />

              <div class="radio-label-vertical-wrapper">
                <small>Excellent</small>
                <label class="radio-label-vertical"><input type="radio" name="q4" value="10" >10</label>
                <label class="radio-label-vertical"><input type="radio" name="q4" value="9" >9</label>
                <label class="radio-label-vertical"><input type="radio" name="q4" value="8" >8</label>
                <label class="radio-label-vertical"><input type="radio" name="q4" value="7" >7</label>
                <label class="radio-label-vertical"><input type="radio" name="q4" value="6" >6</label>
                <label class="radio-label-vertical"><input type="radio" name="q4" value="5" >5</label>
                <label class="radio-label-vertical"><input type="radio" name="q4" value="4" >4</label>
                <label class="radio-label-vertical"><input type="radio" name="q4" value="3" >3</label>
                <label class="radio-label-vertical"><input type="radio" name="q4" value="2" >2</label>
                <label class="radio-label-vertical"><input type="radio" name="q4" value="1" >1</label>
                <small>Poor</small>
              </div>

            </div>
          </div>

          <div class="row reverse-margin">
            <div class="col-md-12 q-box form-group">
              <a data-toggle="tooltip" data-placement="top" title=" * Required"> * </a>How would you like to participate in today's experience?<br /><br />
              <p class="padded">
                <input class="form-check-input" type="radio" name="q5" id="q5_a" value="I will be driving today or may want to drive" required />
                <label class="form-check-label" for="q5_a">I will be driving today or may want to drive</label><br />
                <input class="form-check-input" type="radio" name="q5" id="q5_b" value="I would prefer to ride today" />
                <label class="form-check-label" for="q5_b">I would prefer to ride today</label>
              </p>
            </div>
          </div>

          <!-- release and rules -->
          <div class="row reverse-margin">
            <h6><strong>RELEASE OF LIABILITY AND INDEMNITY AGREEMENT AND PUBLICITY AUTHORIZATION</strong></h6>
          </div>

          <div class="row reverse-margin">
            <div class="col-sm-12 rules-box form-group">
              <p>I hereby agree to participate in Nissan Intelligent Mobility Tour (the “Event”) to be held at San Francisco CA on 2018-06-13, and, on behalf of myself, my family, heirs, personal representatives and assigns, agree to and warrant that:</p>

              <ol>
                <li>I am eighteen (18) years of age or older and have the right to contract in my own name, I agree to act in a reasonable and cautious manner at all times while participating in the Event as a driver or passenger of a Nissan or Infiniti vehicle (the “Vehicle”), and I will use all safety restraint systems at all times while in the Vehicle. I WILL NOT OPERATE THE VEHICLE WHILE UNDER THE INFLUENCE OF DRUGS OR ALCOHOL.</li>
                <li>If I am a driver in this Event, I represent, warrant, and covenant that I am currently and validly licensed and insured to drive a motor vehicle in the United States.</li>
                <li>The details of the Event have been fully explained to me, and I have had the opportunity to ask questions. I have no physical or mental impairment, which might make it dangerous for me to participate in the Event.</li>
                <li>By signing below, I acknowledge that while operating the vehicle I am not under the influence of drugs, alcohol, or medications that may impair ability to operate a motor vehicle and hereby consent to a breathalyzer test to confirm that this statement is true. If the breathalyzer test is taken and failed, Synergy Marketing Partners, LLC and its affiliates have the right to refuse my test drive.  </li>
                <li>I assume full risk of bodily injury, death or property damage, which I may suffer while at the Event, regardless of the cause or any negligence of a Released Party (defined below).</li>
                <li>I assume full responsibility for any bodily injury, death or property damage, which I may cause while at the Event, regardless of the cause or any negligence of a Released Party.</li>
                <li>I will indemnify, defend and hold Nissan North America, Inc. (“NNA”) and its authorized dealers; Nissan Motor Co., Ltd. (“NML”) and its authorized dealers (NNA and NML are collectively referred to herein as “Nissan”); Synergy Marketing Partners, LLC (“SYNMP”; and each of their respective affiliates, shareholders, directors, officers, employees, agents, successors, and assigns (each a “Released Party” or collectively, the “Released Parties”) harmless from any claims, lawsuits   and losses, including without limitation, attorneys’ fees resulting from bodily injury, death or property damage which I may cause to myself or another while at the Event, regardless of the cause or any negligence of a Released Party.</li>
                <li>I grant to Nissan and its authorized dealers; Synergy Marketing Partners, LLC and each of their respective agents and assigns, the absolute right and permission to use, publish and/or broadcast, worldwide, in perpetuity, my name, voice, likeness, picture, photograph and video, in whole or in part, or composites or distortions in character or form, in conjunction with my name, together with or without written or spoken copy (the “Materials”) for advertising, promotional, publicity, public relations purposes in any media including print, television and online media.</li>
                <li>I understand I have no right to inspect or approve the finished Materials prior to use. I understand and agree that I will not be paid for use of any Materials.</li>
                <li>I hereby release, discharge and agree to hold harmless the Released Parties from any liability, claim or cause of action caused by, or arising by virtue of (i) bodily injury, death or property damage which I may suffer while at the Event, regardless of the cause or any negligence of a Released Party, and (ii) any use of the Materials, including but not limited to any liability for claims of defamation or invasion of privacy.</li>
              </ol>

              <p>
                I understand that this entire Agreement is to be interpreted as broadly as possible in favor of the Released Parties. This Agreement shall be interpreted under the laws of the State of Tennessee. Any litigation will be brought in the courts of the State of Tennessee.
                By signing below, I acknowledge that I am also agreeing to receive a ‘thank you’ email with a link to an optional online survey and the opportunity to ‘opt in’ to receive further communications from Nissan.
                I acknowledge that vehicles equipped with telematics features may collect, store and transmit data to Nissan, including data relating to vehicle systems, location, driving performance and operating conditions. I agree that Nissan may, subject to applicable law, use any of this information for any purpose, including but not limited to analyzing vehicle usage and performance, improving product quality, product research and development, market research and marketing.
                FOR CALIFORNIA LOCATIONS ONLY: In addition, and not by way of limitation to the foregoing, I fully understand and knowingly and expressly waive my rights and benefits under Section 1542 of the California Civil Code or under any analogous federal or state law or regulation. Section 1542 of the California Civil Code states that:
                A general release does not extend to claims which the creditor does not know or suspect to exist in his or her favor at the time of executing the release, which if known by him or her must have materially affected his settlement with the debtor.
              </p>
              <p>
                I AM VOLUNTARILY SIGNING THIS AGREEMENT. NO ONE HAS MADE ANY ORAL STATEMENT TO INDUCE ME TO SIGN THIS AGREEMENT. I REALIZE THAT BY SIGNING THIS AGREEMENT, I AM GIVING UP MY RIGHT TO SUE THE RELEASED PARTIES FOR INJURY, DEATH OR DAMAGE I MAY SUFFER AT THE EVENT. IF ANY COURT FINDS A PORTION OF THIS AGREEMENT TO BE INVALID, THE REMAINDER OF THE AGREEMENT WILL NOT BE AFFECTED.
              </p>
              <p>
                MINOR CONSENT<br /> I have requested that the minor(s) listed below be allowed to accompany me as a passenger in the Event. I certify that (i) the person(s) listed below my signature are minor(s); (ii) the full legal name of the minor(s) are accurate as set forth below; (iii) I am the parent or legal guardian of the minor(s) listed below. In consideration for allowing the minor(s) to participate, I agree that the terms of the Agreement above shall likewise bind the minor passengers and their respective family, heirs, personal representatives, and assigns. I hereby release and agree to indemnify, on behalf of each minor listed below, the Released Parties from and against any and all liability arising out of the participation of the minor(s) in the Event.</p>
              <p>
                Talent/Individual Release Form<br /> I hereby irrevocably give Nissan North America the right and permission to copyright and/or publish, reproduce or otherwise use my name, voice and likeness and/or written material, photographs, motion pictures and audio-visual magnetic recordings about or by me for instruction, art advertising, trade or any other lawful purpose whatsoever. I hereby agree to relinquish all rights, title and interest I may have in the finished product or the advertising copy that may be used in connection therewith.
              </p>
            </div>
          </div>

          <!-- checkbox to agree to the rules. -->
          <!-- disabled until user scrolls to the bottom of the rules box -->
          <div class="row">
            <div class="col-md-12 form-group">
              <div class="form-check">
                <input class="form-check-input" type="checkbox" name="agree" id="agree" value="I have read and understood this entire agreement" required disabled />
                <label class="form-check-label" for="agree"><a data-toggle="tooltip" data-placement="top" title=" * Required"> * </a>I have read and understood this entire agreement</label>
              </div>
            </div>
          </div>

          <!-- checkbox for minors attending drive -->
          <!-- toggles additional form with validation requiring at least one name -->
          <div class="row">
            <div class="col-md-12 form-group">
              <div class="form-check">
                <input class="form-check-input" type="checkbox" name="agree_minor" id="agree_minor" value="I have requested that the minor(s) listed below be allowed to accompany me as a passenger in the Event" />
                <label class="form-check-label" for="agree_minor">I have requested that the minor(s) listed below be allowed to accompany me as a passenger in the Event</label>
              </div>
              <!-- hidden form for names of minor atendees -->
              <!-- toggled by checkbox above -->
              <div id="minor_form" class="hidden">
                <div class="row">
                  <div class="col-md-12 form-group">
                    <label for="minor1"><a data-toggle="tooltip" data-placement="top" title=" * Required"> * </a>Minor 1 </label><input type="text" name="minor1" id="minor1" class="form-control" />
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-12 form-group">
                    <label for="minor2">Minor 2 </label><input type="text" name="minor2" id="minor2" class="form-control" />
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-12 form-group">
                    <label for="minor3">Minor 3 </label><input type="text" name="minor3" id="minor3" class="form-control" />
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- signature block area -->
          <!-- can be used with finger (touchscreen) or mouse -->
          <div class="row">
            <div class="col-sm-12 form-group">
              <input type="hidden" name="signature" id="signature" />
              <div id="signature-pad" class="signature-pad">
                <div class="signature-pad--body"><canvas></canvas></div>
              </div>
              <!-- area for date of signature applied -->
              <span id="signed_date"></span>
            </div>
          </div>

          <!-- optins -->
          <div class="row">
            <div class="col-md-12 form-group">
              <div class="form-check">
                <input class="form-check-input" type="checkbox" name="optin1" id="optin1" value="I would like to receive exciting product and event news from Nissan" checked />
                <label class="form-check-label" for="optin1">I would like to receive exciting product and event news from Nissan</label>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-12 form-group">
              <div class="form-check">
                <input class="form-check-input" type="checkbox" name="optin2" id="optin2" value="I would like to be contacted by a Nissan dealer for more vehicle information" />
                <label class="form-check-label" for="optin2">I would like to be contacted by a Nissan dealer for more vehicle information</label>
              </div>
            </div>
          </div>

          <!-- submit form -->
          <div class="row">
            <div class="col-sm-12 form-group">
              <input type="submit" name="submit" id="submit" class="form-control btn red" value="Submit" />
            </div>
          </div>

        </form>

      </div>
    </div>

    <?php require_once 'foot.php'; ?>

    <!-- custom scripts for this project -->
    <script src="assets/js/code-test.js"></script>

  </body>
</html>

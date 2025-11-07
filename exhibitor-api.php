<?php
//ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);
include 'includes/form_constants_both.php';
include 'dbcon_open.php';

exit;

/*//Visitor
//Exhibitor api
$qr_chk_exb_id = mysqli_query($link,"SELECT * FROM `bengaluruite`.`it_visitor_pass` WHERE `event_year` = '2023' LIMIT 900, 150;");// WHERE (reg_id='$temp_reg_id') ");
//$qr_chk_exb_ans = mysqli_fetch_assoc($qr_chk_exb_id);

while($res = mysqli_fetch_assoc($qr_chk_exb_id)) {
	$data = array();
	$cntry= explode("-", str_replace('+', '', $res['fone']));
	$country_code=$cntry[0];
	$phone = $cntry[1];

	$data['name']=$res['fname'] . ' ' . $res['lname'];
	$data['email']=$res['email'];
	$data['country_code']=$country_code;
	$data['mobile']=$phone;
	$data['company']= $res['org'];
	$data['designation']= $res['job_title'];
	$data['category_id']= 744;
	$data['print_val']= 'Business Visitor';
	//$data['booking_id']=$res['pass_no'];
	//callUniversalAPI($data);
	print_r($data);echo '<br/>';
	callVisitorAPI($data);
	
}

exit;*/

$data = array();
	$data['name']='vivek patil';
	$data['email']='vivek.patil@mmactiv.com';
	$data['country_code']='91';
	$data['mobile']='9860108651';
	$data['company']= 'SCI Interlinks';
	$data['designation']= 'Design test';
	$data['category_id']= '743';
	$data['print_val']= 'Exhibitor';
	//$data['booking_id']=$res['pass_no'];
	//callUniversalAPI($data);
	callUniversalAPI($data);
exit;

$data = array();
	$data['name']='vivek patil';
	$data['email']='vivek.patil@mmactiv.com';
	$data['country_code']='91';
	$data['mobile']='9860108651';
	$data['company']= 'SCI Interlinks';
	$data['designation']= 'Design test';
	$data['category_id']= '749';
	$data['print_val']= 'Student';
	//$data['booking_id']=$res['pass_no'];
	//callUniversalAPI($data);
	callVisitorAPI($data);
exit;


/*//Exhibitor api
$qr_chk_exb_id = mysqli_query($link,"SELECT * FROM $EVENT_DB_FORM_EXHIBITOR_DIR_DETAILS_PHASE_1");// WHERE (reg_id='$temp_reg_id') ");
//$qr_chk_exb_ans = mysqli_fetch_assoc($qr_chk_exb_id);

while($qr_chk_exb_ans = mysqli_fetch_assoc($qr_chk_exb_id)) {
	$data = array();
	$data['company_name']= $qr_chk_exb_ans['exhibitor_name'];
	$data['about']= $qr_chk_exb_ans['profile'];
	$data['email']= $qr_chk_exb_ans['email'];
	$data['country_code']= $qr_chk_exb_ans['cntry_code_mob'];
	$data['mobile']= $qr_chk_exb_ans['mob'];
	$data['website']= $qr_chk_exb_ans['website'];
	$data['contact_mobile']= $qr_chk_exb_ans['cntry_code_phone'] . ' ' . $qr_chk_exb_ans['phone'];
	$data['contact_email']= $qr_chk_exb_ans['email'];
	$data['exhibitor_category']= $qr_chk_exb_ans['assoc_nm'];
	print_r($data);echo '<br/>';
	callExhibitorAPI($data);
}

exit;*/

//Call save Operator API
		$data = array();
		$data['company_name']= 'Sagar Infortech';
		$data['about']= '<p>Extended Web AppTech, a prominent software development firm based in Hyderabad, excels in mobile and web applications. As a leading Mobile Application developer, we offer comprehensive design and development support for iOS, Android, and Mobile platforms, along with website development, prioritizing customer satisfaction and maximum output.</p><br /><p>With a decade of steady growth, Extended Web AppTech is a respected name in the technology industry. Our expertise extends to Staff Augmentation, providing dedicated developers for projects of any duration&mdash;long-term, short-term, or hourly. Comprising skilled and experienced developers, our team is committed to delivering impeccable solutions, ensuring the success of our clients endeavors.</p>';
		$data['email']= 's12@test.com';
		$data['country_code']= '+91';
		$data['mobile']= '7894561231';
		$data['website']= 'test.com';
		$data['contact_mobile']= '91 789456136653';
		$data['contact_email']= 's12@test.com';
		$data['exhibitor_category']= 'Testestdsf';
		
		callExhibitorAPI($data);
		exit;
//$list = array(array('RUSHALI RAJASHEKHAR PATIL',' ','rushalipatil2015@gmail.com','Basaveswara Engineering College'),array('MADHUSHREE M V RAO',' ','madhushreev.rao@gmai.com','Basaveswara Engineering College'),array('AVINASH G N',' ','aggowda555@gmail.com','Basaveswara Engineering College'),array('SACHIN S',' ','sachinpunge@gmail.com','Basaveswara Engineering College'),array('ANJALI JAISWAL',' ','anjalijaiswal22594@gmail.com','Dayananda Sagar College of Engineering'),array('ANJALI R GOWDA',' ','anjalirg222@gmail.com','Dayananda Sagar College of Engineering'),array('USHAKIRAN',' ','ushakirankhandale@gmail.com','Dayananda Sagar College of Engineering'),array('N AKSHAY NARAYAN',' ','akshayofi95@gmail.com','Dayananda Sagar College of Engineering'),array('SAHITHYA G',' ','sahithya.sng@gmail.com','Dayananda Sagar College of Engineering'),array('SHIVANAND KUMBAR',' ','mdgshivukumbar@gmai.com','Dayananda Sagar College of Engineering'),array('JEENU GILSON',' ','jeenugilson@gmail.com','Dayananda Sagar College of Engineering'),array('SACHIN',' ','sachin.bh1236@gmail.com','Gulbarga University'),array('NISHA A G',' ','nish.jul28@gmail.com','Gulbarga University'),array('NAGAPOOJA',' ','nagapoojapatil8@gmail.com','Gulbarga University'),array('GULAPPAGOUDA',' ','gulumalipatil1432@gmail.com','Gulbarga University'),array('JYOTHI',' ','jyothisahu10@gmail.com','Gulbarga University'),array('SOUMYA',' ','soumyag1096@gmail.com','Gulbarga University'),array('SUNILKUMAR',' ','sunilkumartegnoor5@gmail.com','Gulbarga University'),array('BHAGYASHREE',' ','bhagyarb159@gmail.com','Gulbarga University'),array('BUTE PARESH SHAILENDRA',' ','pareshbute26@gmail.com','Institute of Agri-Biotechnology'),array('NIVAL RUSHIKESH PRADIP',' ','rushikeshnival133@gmail.com','Institute of Agri-Biotechnology'),array('CHETAN ASHOK VAIDYA',' ','vchetan2906@gmail.com','Institute of Agri-Biotechnology'),array('GADPALE MANIRATNAM',' ','maniratnamgadpale21@gmail.com','Institute of Agri-Biotechnology'),array('LAWANDE MANOJ SANJAY',' ','mannulawande12@gmail.com','Institute of Agri-Biotechnology'),array('YOGESH BHASKAR CHEKE',' ','yogeshcheke60@gmail.com','Institute of Agri-Biotechnology'),array('MADHURI',' ','madhuri1427357@gmail.com','Institute of Agri-Biotechnology'),array('M S SUSHMA',' ','ms.sushmabhat@gmail.com','Institute of Agri-Biotechnology'),array('P B POOJA',' ','pooja.patagar@gmail.com','Institute of Agri-Biotechnology'),array('MD NEMATULLAH',' ','md_nemat@yahoo.co.in','JSS College of Arts, Commerce & Science'),array('RINEESH MILTON',' ','rineeshm_bt17-19@macfast.ac.in','JSS College of Arts, Commerce & Science'),array('DURGA VENUGOPAL',' ','durgav_bt17-19@macfast.ac.in','JSS College of Arts, Commerce & Science'),array('SUSHMA G',' ','sushma1825sush@gmail.com','JSS College of Arts, Commerce & Science'),array('GAGANA N',' ','gaganakgl@gmail.com','JSS College of Arts, Commerce & Science'),array('SRINIVASA S',' ','srinivasbapu1997@gmail.com','JSS College of Arts, Commerce & Science'),array('MRINAL PATIL',' ','mrinalpatil96@gmail.com','JSS College of Arts, Commerce & Science'),array('R VYSHNAVI',' ','vyshnavi1196@gmail.com','JSS College of Arts, Commerce & Science'),array('S G PREETHAM',' ','preetham.soodana@gmail.com','JSS College of Arts, Commerce & Science'),array('SINCHANA K S',' ','sinchanaks96@gmail.com','JSS College of Arts, Commerce & Science'),array('MANASA JAIN N D',' ','manasajain462@gmail.com','JSS College of Arts, Commerce & Science'),array('HARSHITHA R',' ','harshuraamvatsa@gmail.com','JSS College of Arts, Commerce & Science'),array('YALLUBAI CHOUDARI',' ','deepamac1993@gmail.com','KLE Technological University'),array('SWAROOPARANI DEVENDRA BADIGER',' ','swarooparanibadiger@gmail.com','KLE Technological University'),array('POOJA B DODDAMANI',' ','poojabd2@gmail.com','KLE Technological University'),array('SUPRIYA S KAMMAR',' ','kammar.supriya@gmail.com','KLE Technological University'),array('SNEHA FAKEERGOUDA PATIL',' ','snehafp96@gmail.com','KLE Technological University'),array('SHWETA C HIREMATH',' ','shwetachikki4@gmail.com','KLE Technological University'),array('SAYYED SHAMABANU',' ','shamasayyed0502@gmail.com','Mount Carmel College'),array('SONALI SAINI',' ','sonali7195s@gmali.com','Mount Carmel College'),array('VEENA R V',' ','veena.rv50a@gmail.com','Mount Carmel College'),array('SHIVANI SHUKLA',' ','shivani.99.shukla@gmail.com','Mount Carmel College'),array('SWATILINA DAS',' ','swatimon.sd@gmail.com','Mount Carmel College'),array('NANCY LALHRIATPUII',' ','richardrexstevens@gmail.com','Mount Carmel College'),array('DIVYASHREE H S',' ','divyadaaliga@gmail.com','Mount Carmel College'),array('KUMUDA K N',' ','kumudagowda567@gmail.com','Mount Carmel College'),array('ANAGHA RAO',' ','anagharao108@gmail.com','Mount Carmel College'),array('SHEEBA H MALEKAR',' ','sheebamalekar3895@gmail.com','Mount Carmel College'),array('PAVITRA MAHADEVAPPA SANGANAL',' ','pavitra14101996@gmail.com','Mount Carmel College'),array('RAKSHITHA N',' ','rakshithanagarajablore@gmail.com','Mount Carmel College'),array('SUPRIYA YALPU',' ','supriyayalpu983980@gmail.com','Mount Carmel College'),array('A ANUREKHA',' ','anuashok3011@gmail.com','Mount Carmel College'),array('ARPITHA REDDY R N',' ','arpireddy96@gmail.com','Mount Carmel College'),array('KAVYA R',' ','kavya106@gmail.com','Mount Carmel College'),array('BERIN BABU',' ','berinbabu28@gmail.com','Maharani Lakshshmi Ammanni College for Women'),array('SAKSHI SHARMA',' ','sakshisharma.3445@gmail.com','Maharani Lakshshmi Ammanni College for Women'),array('JAMADAR SUMAN VIKRAM',' ','sumanjamadar4@gmail.com','Maharani Lakshshmi Ammanni College for Women'),array('NITHYA V JOHN',' ','nithyavjohn77@gmail.com','Maharani Lakshshmi Ammanni College for Women'),array('SUDIPTA SAHA',' ','riyasaha5039@gmail.com','Maharani Lakshshmi Ammanni College for Women'),array('BIDIPTA ROY',' ','bidiptaroy2@gmail.com','Maharani Lakshshmi Ammanni College for Women'),array('EKTA VERMA',' ','ektaverma352@gmal.com','Maharani Lakshshmi Ammanni College for Women'),array('NAIKWADI MISBA BAWALAL',' ','misbanaikwadi00@gmail.com','Maharani Lakshshmi Ammanni College for Women'),array('SUNILKUMAR J',' ','suniljaikumar2014@gmail.com','Maharani Lakshshmi Ammanni College for Women'),array('ROSEMARY',' ','markalrosemary@gmail.com','Maharani Lakshshmi Ammanni College for Women'),array('BISMILL ZEESHAN AHMED',' ','meharajzee@yahoo.in','Maharani Lakshshmi Ammanni College for Women'),array('USHA S RAMU',' ','ushashantharam@gmail.com','Maharani Lakshshmi Ammanni College for Women'),array('SHRUTHI POOJARI',' ','shruthipoojary27@gmail.com','Maharani Lakshshmi Ammanni College for Women'),array('SUJATA',' ','sanju936nayak@gmail.com','Maharani Lakshshmi Ammanni College for Women'),array('MAHIMA CHOUDHARY',' ','sirohamahi@gmail.com','Maharani Lakshshmi Ammanni College for Women'),array('ADITHYA B R',' ','adithyabr1997@gmail.com','Maharani Lakshshmi Ammanni College for Women'),array('ARIL B S',' ','arilbs15@gmail.com','Maharani Lakshshmi Ammanni College for Women'),array('HARISH R',' ','hari77800@gmail.com','Maharani Lakshshmi Ammanni College for Women'),array('ABHISHEK E',' ','abhieshwar01@gmail.com','Maharani Lakshshmi Ammanni College for Women'),array('BHARADWAJA SHOBITHA',' ','shobithasinghb@gmail.com','Ramaiah Institute of Technology'),array('ANJALI T',' ','anjaliajayan09@gmail.com','Ramaiah Institute of Technology'),array('BHOSALE ANITA SHAHAJI',' ','bhosaleanita610@gmail.com','Ramaiah Institute of Technology'),array('ABILASHA J',' ','abiilasha.22@gmail.com','Ramaiah Institute of Technology'),array('DONA JOJO',' ','donajojo0777@gmail.com','Ramaiah Institute of Technology'),array('MEGALA V',' ','meenamegala06@gmail.com','Ramaiah Institute of Technology'),array('MITU KUMARI KARN',' ','mitubiotech@gmail.com','Ramaiah Institute of Technology'),array('PANKAJ KUMAR',' ','p.pankaj0205@gmail.com','Ramaiah Institute of Technology'),array('PARVATHI M A',' ','parupandavath@gmail.com','Ramaiah Institute of Technology'),array('DEBIKA CHAKRABARTY',' ','debikachakrabarty012@gmail.com','Ramaiah Institute of Technology'),array('SHIVALEELA',' ','sonubabchedi413@gmail.com','Ramaiah Institute of Technology'),array('YUVARAJ T H',' ','yuvarajtalwar9@gmail.com','Ramaiah Institute of Technology'),array('KHALEDAJIYABEGAM AMINADIN PATHAN',' ','jiyapathan000@gmail.com','Ramaiah Institute of Technology'),array('NAMRATA DURGASINGH KATEWAL',' ','katewalnamrata@gmail.com','Ramaiah Institute of Technology'),array('VIDYA KALASA',' ','vidyakalasa66@gmail.com','Ramaiah Institute of Technology'),array('NAGESH Y R',' ','nagesh.nagu1994@gmail.com','Ramaiah Institute of Technology'),array('MOHAMMED SADATH HUSSAIN',' ','md.sadath123@gmail.com','Ramaiah Institute of Technology'),array('SUSHMA KUMARI',' ','sushma.1h.sb@gmail.com','PES University'),array('NADAF SAMRIN HAMID',' ','samonadaf.5678@gmail.com','PES University'),array('MRINAL PRAKASH SHENDRE',' ','mrinalshendre24@gmail.com','PES University'),array('DIKSHA PANDEY',' ','pandeydiksha1995@gmail.com','PES University'),array('DEEPAK KUMAR',' ','ideepkr1685@gmail.com','PES University'),array('KIRAN RAJEEV KUMAR',' ','kiranrjv@gmail.com','PES University'),array('VALMIKI SAILAJA NAIDU',' ','valmikisailaja97@gmail.com','PES University'),array('CHANCHAL CHATTERJEE',' ','chanchalchithi@gmail.com','PES University'),array('SARBAJIT CHAKRABARTI',' ','sarbasubha2@gmail.com','PES University'),array('ANIRUDH JAIRAM',' ','anirudhjay97@gmail.com','PES University'),array('MADHURA H N',' ','madhurahebbandi25@gmail.com','PES University'),array('KIRANA SHUBHASRI R',' ','kiranashubhasrir984@gmail.com','PES University'),array('AMEEN SABI DS',' ','ameensabids@gmail.com','PES University'),array('PRIYANKA ASANGI',' ','priyanka.asangi@gmail.com','PES University'),array('AKSHATA BADACHI',' ','akshata.badachi@gmail.com','PES University'),array('RAJITHA A',' ','rajithasangam94@gmail.com','PES University'),array('MANASA B REDDY',' ','bmanasareddy143@gmail.com','PES University'),array('MEENAKSHI SR',' ','meenasr20@gmail.com','PES University'),array('MELITA RASHMI REBELLO',' ','melitarashmi98@gmail.com','PES University'),array('KORADE ADITI RAVI',' ','rkorade@gmail.com','Padmashree Institute of Management & Sciences'),array('GOWDA SAMPREETH RAVI',' ','sampreethgowda35@gmail.com','Padmashree Institute of Management & Sciences'),array('MEGHA MADHU',' ','madhu.megha1997@gmail.com','Padmashree Institute of Management & Sciences'),array('SUTANUKA PAL',' ','sutanukapal202@gmail.com','Padmashree Institute of Management & Sciences'),array('NAGALURU VENKATESH SAI SWAROOP',' ','nvsaiswaroop@gmail.com','Padmashree Institute of Management & Sciences'),array('CHRISTIAN MICHELE PERESH',' ','michelepchristian@gmail.com','Padmashree Institute of Management & Sciences'),array('JIS ELDHOSE',' ','jiseldhose5@gmail.com','Padmashree Institute of Management & Sciences'),array('SURANJALI DAS KARMAKAR',' ','anjalidaskarmakar@gmail.com','Padmashree Institute of Management & Sciences'),array('NARESH KUMAR TALWAR',' ','nareshtalwar550@gmail.com','Padmashree Institute of Management & Sciences'),array('SOWMYA K M',' ','sowmya123sms@gmail.com','Padmashree Institute of Management & Sciences'),array('VISHWAS M',' ','75vishwas@gmail.com','Padmashree Institute of Management & Sciences'),array('CHINMAYI',' ','chinmayi.kotur06@gmail.com','Padmashree Institute of Management & Sciences'),array('SPOORTHI GOPAL GUDDADMANE',' ','spoorthi.g.986.sg@gmail.com','Padmashree Institute of Management & Sciences'),array('ABHISHEK RAGHUVEERA NAIK',' ','naikabhi1718@gmail.com','Padmashree Institute of Management & Sciences'),array('ADARSHA K N',' ','adarshgowda.ns.20@gmail.com','Padmashree Institute of Management & Sciences'),array('MADHU D NAIK',' ','dnaikmadhu@gmail.com','Padmashree Institute of Management & Sciences'),array('B N MEGHANA',' ','bnmeghana96@gmail.com','Padmashree Institute of Management & Sciences'),array('AMITHA BAMANI B M',' ','amithabamani@gmail.com','Padmashree Institute of Management & Sciences'),array('CHRISTINA RAJU',' ','christinaraju2013@gmail.com','St. Aloysius College'),array('AVINASH PRABHAKAR AGLAVE',' ','avinashaglave3020@gmail.com','St. Aloysius College'),array('FATHIMA KAZREENA',' ','fathimakazreena.75@gmail.com','St. Aloysius College'),array('MARIYAM',' ','maryam.qanitha18@gmail.com','St. Aloysius College'),array('ALVA MELITA ALWIN',' ','alvamelita5@gmail.com','St. Aloysius College'),array('ROOPAKSHI',' ','roopakshishetty@gmail.com','St. Aloysius College'),array('FERNANDES SUNITA DOMINIC',' ','sunita.fernandes02@gmail.com','SDM Medical Research and Hospital'),array('MAYUKH GAUTAM BANERJEE',' ','bannerg1996@gmail.com','SDM Medical Research and Hospital'),array('ASTHA SINGH',' ','asthasingh1997@gmail.com','SDM Medical Research and Hospital'),array('BHARAT HALABHAVI',' ','shibharat@gmail.com','SDM Medical Research and Hospital'),array('SHRUTI KULKARNI',' ','skshruti1997@gmail.com','SDM Medical Research and Hospital'),array('SANGEETA DHANYAKUMAR PARWAPUR',' ','parwapursangeeta27@gmail.com','SDM Medical Research and Hospital'),array('HEMAHANUMANTH SHALAVADI',' ','shalavadihema@gmail.com','SDM Medical Research and Hospital'),array('TRUPTI CHITRAGAR',' ','truptimc24@gmail.com','SDM Medical Research and Hospital'),array('SOUMYA SATISH HARAPANAHALLI',' ','soumyaharapanahalli26@gmail.com','SDM Medical Research and Hospital'),array('DIVYA NAYAK',' ','divyagn30@gmail.com','SDM Medical Research and Hospital'),array('RAKESH HESARUR',' ','rakesh.hesarur@gmail.com','SDM Medical Research and Hospital'),array('VEERESH TEJAPPA NAYAK',' ','veereshnayak30@gmail.com','SDM Medical Research and Hospital'),array('HAMSA M R',' ','hamsaramthanu03@gmail.com','SDM College'),array('NEETHU ANJU JACOB',' ','neethujacob63@gmail.com','Siddaganga Institute of Technology'),array('VINAY S YADAV',' ','vin966@gmail.com','Siddaganga Institute of Technology'),array('KUSUM',' ','ksmkdn26@gmail.com','Siddaganga Institute of Technology'),array('MAYANK KOHLI',' ','mkmayankkohli@gmail.com','Siddaganga Institute of Technology'),array('ATHIRA K R',' ','aatirarajendran@gmail.com','Siddaganga Institute of Technology'),array('SARASWATI AWASTHI',' ','saumya22494@gmail.com','Siddaganga Institute of Technology'),array('SAMYAMI DP',' ','samyamidp95@gmail.com','Siddaganga Institute of Technology'),array('YASHASWINI G',' ','yashugowda271@gmail.com','Siddaganga Institute of Technology'),array('R S AKASH',' ','akashrs480@gmail.com','Siddaganga Institute of Technology'),array('SHRIHITH A',' ','shrihith93@gmail.com','Siddaganga Institute of Technology'),array('LIKITH M',' ','likithm55@gmail.com','Siddaganga Institute of Technology'),array('ASHWIN RAJEEV',' ','ar2scape@gmail.com','School of Lifesciences, MAHE'),array('MAITHILI HEDAOO',' ','maithili321@gmail.com','School of Lifesciences, MAHE'),array('ATHIRA VISWAMBHARAN',' ','athiraviswambharan0@gmail.con','School of Lifesciences, MAHE'),array('SOUMYA RANJAN PRADHAN',' ','ranjansoumya115@gmail.com','School of Lifesciences, MAHE'),array('NANDINI MUTHUVELAN',' ','nandinimuthuvelan@yahoo.co.in','School of Lifesciences, MAHE'),array('KHADIJA',' ','khadijamrashid97@gmail.com','School of Lifesciences, MAHE'),array('SHARMA RAJNI INDRAJEET',' ','rshrajni96@gmail.com','School of Lifesciences, MAHE'),array('ADITHYA BABU T',' ','adithya8babu@gmail.com','School of Lifesciences, MAHE'),array('HARSHITHA G',' ','harahuharshitha69@gmail.com','School of Lifesciences, MAHE'),array('TEJAL DEEPAK DURGEKAR',' ','tejalddurgekar@gmail.com','School of Lifesciences, MAHE'),array('SAHANA N M',' ','sahananm15@gmail.com','School of Lifesciences, MAHE'),array('GAJENDRA PRASAD J',' ','manja9693@gmail.com','School of Lifesciences, MAHE'),array('MEENAKSHI M',' ','minchumeena28@gmail.com','School of Lifesciences, MAHE'),array('NETRAVATI ANGADI',' ','netraangadi9@hmail.com','School of Lifesciences, MAHE'),array('JAHNAVY MADHUKAR JOSHI',' ','jahnavyj@gmail.com','School of Lifesciences, MAHE'),array('RAMYASHREE M B',' ','mbramyashree96@gmail.com','School of Lifesciences, MAHE'),array('ASHARANI N',' ','ashanag333@gmail.com','School of Lifesciences, MAHE'),array('AAKANKSHA J SHETTY',' ','akshu2015chit@gmail.com','School of Lifesciences, MAHE'),array('DEBARUN BANERJEE',' ','debarunbanerjee24@gmail.com','The Oxford College of Science'),array('VINAY KUMAR',' ','vinaykumar9724@gmail.com','The Oxford College of Science'),array('JINJU JOSE',' ','susanjose22@gmail.com','The Oxford College of Science'),array('SRIJANI MUKHERJEE',' ','srijani1992mukherjee@gmail.com','The Oxford College of Science'),array('SUSHMA K P',' ','sushmapadmashale48@gmail.com','The Oxford College of Science'),array('EESHA B R',' ','bacchu.esh@gmail.com','The Oxford College of Science'),array('JYOTHI P',' ','jojyothi739@gmail.com','The Oxford College of Science'),array('DISHA PRABHU',' ','dishabevinkatti06@gmail.com','The Oxford College of Science'),array('SHRILAXMI S BHAT',' ','bhatshri1997@gmail.com','The Oxford College of Science'),array('PRIYANKA IYENGAR K',' ','krishnapriya18msc@gmail.com','The Oxford College of Science'),array('KEERTHANA N',' ','keerthanan371@gmail.com','The Oxford College of Science'),array('ARSHA K K',' ','k.arshaash96@gmail.com','The Oxford College of Science'),array('SARANYA K',' ','saranyamurali333@gmail.com','Yenepoya'),array('NEELANCHAL VAID',' ','vaidneel@gmail.com','Yenepoya'),array('AKANKSHA SHIVAJI NIKAM',' ','akankshanikam97@gmail.com','Yenepoya'),array('A RAKSHA SURESH',' ','raksha17suresh@gmail.com','Yenepoya'),array('DEEPAK K',' ','newis27deepak@gmail.com','Yenepoya'),array('PRAMUKH SUBRAHMANYA HEGDE',' ','pshegde4@gmail.com','Yenepoya'),array('BASAVARAJU KC',' ','basavarajkc95@gmail.com','Yenepoya'));

/*if(isset($_GET['a']) && $_GET['a'] == 1) {
	//New data
	$list = array(array('Mr. Bhavesh Gadhethariya"','Infinity Transoft Solution Pvt. Ltd.','bhavesh@infinityinfoway.com'), array('Mr. A. Afzal','Parveen Travels','afzal@parveentravels.com'), array('Mr. Amol  Sawant','KPIT','amol.sawant@kpit.com'), array('Mr. Aniket  Bhagel','IBIBO Group Pvt. Ltd','aniket.baghel@redbus.com'), array('Mr. Chandrashekar ','BMTC','dtoopn@mybmtc.com'), array('Mr. Deepak Y','eZee Info Solutions','deepak@ezeeinfosolutions.com'), array('Mr. G. L. Sharma','Shree Damodar Coach Craft Pvt. lTd.','sdccblr@gmail.com'), array('Mr. Girish','Bitla','girish.g@bitlasoft.com '), array('Mr. Jayakumar A R','MRF Limited','jayakumar.ar@mrfmail.com'), array('Mr. K P Singh','Eberspaecher Suetrak Bus Climate Control Systems India Pvt. Ltd','kp.singh@eberspaecher.com'), array('Mr. K.T.Rajashekhara','Bus Operators Confereation of India (BOCI)','mails@srstravels.net'), array('Mr. Kanwarjit Singh Sawhney','Bakshi Transport Services','bobbysawhney@bakshitransportservice.net'), array('Mr. Kirit Morzaria','KHT Agencies Pvt. Ltd.','kirit_morzaria@khtagencies.com'), array('Mr. Lakhan  Singh','Anand Automotve (P) Ltd.','lakhan.singh@anandgroupindia.com'), array('Mr. Lokesh C','SRS Travels','mails@srstravels.net'), array('Mr. Madhu Raghunath','T V Sundram Iyengar & Sons Private Limited','madhu.raghunath@tvs.in'), array('Mr. Manish  Kaushal','Mahindra Electric Mobility limited','kaushal.manish@mahendraelectric.com'), array('Mr. Nakul Kukar','Cell Propulsion','nakulkukar@cellpropulsion.com'), array('Mr. Prabhu Salageri','Vijayanand Travels','prabhu@vrllogistics.com'), array('Mr. R. C. Pareek','Azad Coach Builders Pvt. Ltd.','accounts.azad@azadgroup.in'), array('Mr. R. Rajakumar','Hyundai Motor India Ltd.','rrajakumar@hmil.net'), array('Mr. Ranganathan','Ashok Leyland Limited,','ranganathan.j@ashokleyland.com'), array('Mr. Ravi  Ranganathan','Allins Business Solution s (P) Ltd','ravi@allins.in'), array('Mr. Sandeep Singh','JK Tyre & Industries Ltd.',' ztm.west@jkmail.com'), array('Mr. Santosh Murugan','Daimler India Commerical Vehicles Pvt. Ltd.','santhosh.murugan@daimler.com'), array('Mr. Sathyanarayanan','3M India Limited Research & Development','ssaketharam@mmm.com'), array('Mr. Siddarth Sharma','Nippon Paint (India) Pvt. Ltd.','siddarth.sharma@nipponpaint.co.in'), array('Mr. Suil Kumar Sharma','Sharma Transports','sunilks25@yahoo.com'), array('Mr. Swapnil  Kumbhar','Intangles','swapnil.kumbhar@intangles.com'), array('Mr. Thiruvengadam J','Brakes India Private Limited','thiruvengadam.j@brakesindia.co.in'), array('Mr. Venkatesan','Burma Automotives (Pvt) Ltd','burmasmli@gmail.com'), array('Mr. Vinayaka K','Trident Automobiles Pvt. Ltd.','vinayaka@tridenthyundai.com'), array('Mr. Rohit Srivastava','TATA Motors Ltd.','srivastava.rohit@tatamotors.com '), array('Ms. Radha Golla','Sun Mobility Pvt. Ltd','radha@sunmobility.co.in'), array('Ms. Rupa Nandy','UITP','rupa.nandy@uitp.org'), array('Mr. Vikram K  Ramanathan','Advinus Therapeutics Limited','vikram.ramanathan@advinus.com'), array('Mr. B.G. Keshava Murthy','Aeronautical Development Agency (ADA)','bgkeshava@rediffmail.com'), array('Dr.  S  Venugopal','Aeronautical Development Establishment (ADE)','director@ade.drdo.in '), array('Mr. K. Ramakrishnan','Anthem Biosciences Pvt. Ltd.','ramkrishnan.k@anthembio.com'), array('Dr. Tappan Kumar Shah','AstraZeneca Pharma India Limited','tappankumar.shah@astrazeneca.com'), array('Mr. Murali Ramachandra','Aurigene Discovery Technologies Limited','murthy_csn@aurigene.com'), array('Dr. MeenaKashi Nagi','Ayurveda Yoga & Naturopathy,Unani, Siddha & HomoeopathyH','directorayush@gmail.com'), array('Mr. Chandrasekhar Nair','Bigtec Pvt. Ltd.','bc@bigtec.co.in'), array('Dr. Christiane Hamacher ','Biocon Biologics India Limited','christiane.hamacher@biocon.com'), array('Mr. Basha ','British Biologicals','basha@britishbiologicals.com'), array('Dr. Giridhar U.  Kulkarni','Centre for Nano and Soft Matter Sciences','gukulk@gmail.com'), array('Mr.  B.S Bindhumadhava','Centre for Development of Advanced Computing (C-DAC)','bindhu@cdac.in'), array('Shri. K.  Ramchand','Centre for Development of Telematics (C-DOT)','edr@cdot.in'), array('Dr.  R.K. Sharma','DRDO-Defence Food Research Laboratory (DFRL)','director@dfrl.drdo.in'), array('Mr.  Deep  Kanakia','Drone Federation of India (DFI)','deep@dronefederation.in'), array('Shri S.S. Nagaraj','Electronics and Radar Development Establishment (LRDE)','director@lrde.drdo.in'), array('Mr.  M.R.  Seetharam','Electronics City Industries Association (ELCIA)','ceo@elcia.in'), array('Dr. Durairaj Sathishkumar','G7 Synergon Pvt.Ltd.','md@g7synergon.in'), array('Ms Surya Kala','India Electronics & Semiconductor Association President - IESA','suriya@iesaonline.org'), array('Mrs. Sudha Subramanian','Internet and Mobile Association of India (IAMAI)','sudha@iamai.in'), array('Mr. Vinod Kumar Gupta','Kemwell Biopharma Pvt. Ltd.','vinodkumar.gupta@kemwellpharma.com'), array('Mr. V. Shankar','Metahelix Life Sciences Ltd.','info@meta-helix.com'), array('Mr. Mallikarjun Sundaram','Mitra Biotech','mallik@mitrabiotech.com'), array('Mr. Krishna ','Molecular Connections Pvt. Ltd.','krishna@molecularconnections.com'), array('Dr. Varsha Shridhar','Molecular Solutions Care Health','varshaishere@gmail.com'), array('Mr. Mahesh G.  Shetty','Multiplex group','mgshetty@multiplexgroup.com'), array('Mr. Jitendra J. Jadhav','National Aerospace Laboratories (NAL), Bangalore','director@nal.res.in'), array('Dr. B. N.  Gangadhar ','National Institute of Mental Health and Neuro Sciences (NIMHANS)','dirstaff@nimhans.ac.in'), array('Mr. Ravi Kumar','National Small Industries Corpotaion Limited (NSIC)','ravikumar@nsic.co.in'), array(' Mr. Deepak Mundkinajeddu','Natural Remedies Pvt. Ltd.','deepak@naturalremedy.com '), array('Mr. V.G  Nair','Sami Labs Ltd.','vg@samilabs.com'), array('Dr. Sowmya Lakshmi  Balendiran ','Sea6 Energy - Bangalore','sowmya@sea6energy.com'), array('Dr. Ezhil Subbian','String Bio Pvt. Ltd.','subbiane@stringbio.com'), array('Mr.  Rajan S  Mathews','The Cellular Operators Association of India (COAI)','rsmathews@coai.in'), array('Mr. P.J. Haydon','The Himalaya Drug Company','p.j.haydon@himalayawellness.com'), array('Ms. Jitika  Narang','The Indo - American Chamber of Commerce(IACC)','jitika@iaccindia.com'), array('Dr. Ravi Kumar Banda ','Xcyton Diagnostics Pvt. Ltd.','ravikumar@xcyton.com'), array('Pranay Gupta','91 Springboard ','pranay@91springboard.com '), array('Pazhanimuthu Annamalai','Aura biotechnologies private limited','pazhanimuthu@gmail.com'), array('Jitender  Kumar','BBC','director@bioinnovationcentre.com '), array('M.K. Ravindra','Bhive Workspace','ravi@bhiveworkspace.com'), array('Divya Chandradhara','BioAgile Therapeutics Pvt Ltd','divya@bioagiletherapeutics.com '), array('Rajiv Mukherjee','Brigade Innovations LLP','rajeev@brigadereap.com'), array('Dr. Raja','BTSFI',''), array('','Cisco Launchpad','cisco-launchpad@cisco.com'), array('Adreesh Chatterjee','Clinimed Lifesciences Pvt Ltd','adreesh.c@aqbsolutions.com'), array('Syed Moin','Digital Shark','syed.moin@digitalshark.in'), array('Lavanya Raj','Genio Solutions LLp','lalumaria@yahoo.com'), array('Vinod  Shankar','Global Incubation Services (Ginserv)','vinod@ginserv.in'), array('Sanjeev','Glyph Solutions','Sanjeevh@glyph.solutions'), array('Santhosh SS','GoDhiyo Solutions Pvt Ltd','santhosh@dhiyo.ai'), array('Venkat Raman','HDFC StartUp Cell','Venkat.Raman@hdfcsec.com'), array('Mr. Ravikumar Tummalacharla','HiContainments International Pvt. Ltd.','info@hicontainments.com'), array('Ashish Sharma','HotStay','ashishsharma@hotstay.in'), array('Amit Mittal','Humalitix','amitmital702@gmail.com'), array('Amit Ahuja','Infinite Possibilities','amitahuja21@hotmail.com'), array('Chethan','Infolink','infolink.bcare@yahoo.co.in'), array('Shikha Bhatt','Innovators Bay','shikha.bhatt@innovatorsbay.com'), array('Ravi Kasibhatla','Invage Systems','s.kumar@invagesystems.com'), array('Shanmukha','iRack India','shanmukha@irackindia.com'), array('Samith Rao','iSPAGRO','samith.rao@ispagro.in'), array('Rakesh','Katidhan','rakesk@katidhan.com'), array('Puneet H S','LiveKraft','puneet@livekraft.com'), array('Ananya Madhav','MEDTECH FOR ALL','medtechforall@gmail.com'), array('DIlipkumar S','Mentric Technologies Pvt Ltd','dilipkumar@mentricgroup.com'), array('','Nadathur S Raghavan Centre for Entrepreneurial Learning ,NRSCEL',''), array('K.S. Vishwanath','NASSCOM','ksv@nasscom.in'), array('Ganesh','Neshaju Envirotech','ganesh@neshajuenvirotech.com'), array('Deepankar Biswas','Offer Grid','deeps@offergrid.com'), array('Durgadas Shetty','Primesophic','das@primesophic.com'), array('Tanya Bajaj','Punjab university','tanyabajaj92@gmail.com'), array('Hritika Bhagat','Quality Compliance','hritikabhagat@qualitycomplianceltd.com'), array('K Sachin Reddy','Ragno Electronics Private Limited','sachinreddykurapati8@gmail.com'), array('Surendra V','RKS POWER SOLUTIONS','surendrav@rkspowersol.com'), array('Abhijit S','Sign Desk','abhijith.ns@legaldesk.com'), array('Sikandar','SIKI','sikandar.tapal@gmail.com'), array('Khushagra','SIXS INNOVATIONS AND MARKETING OPC PRIVATE LIMITED','kush@6smarketers.com'), array('Basavaraj Pujar','Someshwara Software Pvt Ltd','basavaraj@someshwarasoftware.com'), array('Devdeep','Tansitus NexGen','dev@transitusnexgen.com'), array('','TAS India',''), array('Bala','Techstarts ','bala.girisaballa@techstarts.com'), array('Shalini','TLabs-Times Internet Limited','shalini@tlabs.in'), array('Venkatesh Valluri','Valluri Technology Accelerators','venkatesh@valluriorg.com'), array('Anurag','Vridhii Digital Private Limited','anurag@vridhii.com'), array('Nancy Colecraft','WeWork','nancy.colecraft@wework.co.in'), array('Satyanaray Nanda','Winavit','satya_89@yahoo.com'), array('Dr. Anirban Pal','Prakhoj Pvt. ltd','anirban.pal@prarasbiosciences.com'), array('Bushra Killedar','Digital Jalebi','bushra@digitaljalebi.com'), array('','Altiostar Networks India ','info@altiostar.com'), array('Nilesh Sangoi','Meru Mobility Tech Private Limited','nilesh.sangoi@meru.in'), array('Arjun Singh','Envestnet / Yodlee','asingh3@yodlee.com'), array('Mr. Marcel J. Velterop','Jubilant Biosys Limited','marcel.velterop@jubliantbiosys.com'), array('Mr. Arun Kumar','ITI Limited','arunkumar_bgp@itiltd.co.in'), array('Srinath K','JH Bio Innovations Pvt. Ltd.','srinath@jhindia.com'), array('Mr. Rakesh Kasba','JALODBUST','rakesh@jalodbust.com'), array('Mr. Vaidyanathan','PAQs','vaidy@paqs.biz'), array('Nitin','Dimakh Consultants Private Limited','support@dimakhconsultants.com'), array('Mr. Shreyana Duga',"Hudson's Bay Services Pvt. Ltd",'shreyana.dugar@hbc.com'), array('Mr. Gopala Krishna','Honeywell Technology Solutions India Pvt. Ltd. ','gopala.gudimetla@honeywell.com '), array('Mr. L.V.V. Gupta','JUSTWIPES ','bmpl1989@yahoo.com'), array('Ms. Lalitha Indrakanti','Cargill Business Services India Pvt. Ltd.','lalitha_indrakanti@cargill.com'), array('Mr. Badrinath Bharadwaj','Firstsource Solutions Ltd.','badrinath.bharadwaj@firstource.com'), array('Naveen','DoArt','info@@doart.in'), array('Dr. K. Maheshwara Reddy','Defence Avionics Research Establishment (DARE)','director@dare.drdo.in'), array('Mr. Rajiv Kuruvilla','D1 Fortification, India','rajiv@d1secure.com'), array('Mr. Bharat  Goenka','Tally Solutions','bharat@tallysolutions.com'), array('Dr. Upendra  Kumar Singh','Centre for Artificial Intelligence and Robotics','director@cair.drdo.in'), array('Anil Kumar Bhandari','India Coffee Trust','presidentindiacoffeetrust@gmail.com'), array('','Maharashtra Economic Development Council','medc@medcindia.com'), array('Sandeep Chattar','SOPPA - Logistics','contact@soppa.co.in '), array('Balasubrahmanyan','Rolls-Royce India Pvt. Ltd','jayaram.Balasubrahmanyan@Rolls-Royce.com'), array('Mr. Ashwin Ramachandra','Sasken Technologies Limited ','ashwin.ramachandra@sasken.com'), array('Dr. Ravindra Pushker','Monsanto Holdings Pvt. Ltd.','ravindra.pushker@monsanto.com'), array('Mr. Rajiv Sawhney','NSRCEL, Indian Institute of Management','rajiv.sawhney@iimb.ac.in'), array('Mr. Raja Balusamy','Samsung R&D Institute India','rajaprint@gmail.com'), array('Suryanarayana Raju P.','WM Global Technology Services India ',''), array('sangeeta Pillai','Synergy Pvt. ltd ','sangeeta786pillai@gmail.com'), array('Mr. Ganesh Papanna','Purple Rock Entertainments ','ganesh@purplerock.in'), array('Mr. Prasanna Patwardhan','PRASANNA PURPLE MOBILITY SOLUTIONS','secretary@prasannapurple.com'), array('Dr. Dilipkumar, D','Veterinary College, Bidar','deanvcb@gmail.com'), array('Guruchanna Malawad ','SVPVVSAMSTE BADAMI ','gurumalawad@gmail.com'), array('Mr. Kiran Raj','LeafBox','airleafbox@gmail.com'), array('Rakesh Kumar','OhiO Softwares LLP','rakesh@ohiosoftwares.com'), array('Jaison Pappachan','Blockconnectors Labs Pvt. Ltd.','jaison@blockconnectorslabs.com'), array('A LAKSHMI NARASIMHAN','DATA COLLECTION INFOTECH (INDIA) PVT. LTD.','nara@datacollectionindia.co.in'), array('Mrs. Akshata Kari','Cocoslabs Innovative Solutions Pvt Ltd','akshata@pixuate.com'), array('Mr. Hitesh Garg','Hindustan Mines and Minerals P','info@hindustanmines.in'));
} else {
	$list = array(array('Tejaswini Patil', 'SCI Interlinks', 'tejaswini.patil@interlinks.in'), array('Mayuri Ladi', 'SCI Interlinks', 'mayuri.ladi@interlinks.in'), array('Sagar Patil', 'SCI Interlinks', 'sagar.patil@interlinks.in'));
}

echo '<pre>';// . count($list);
//print_r($list);exit;
for($i = 0; $i<count($list); $i++) {
	$det = $list[$i];
	$data['name']=$det[0];
	$data['company']= $det[1];
	$data['email']= $det[2];
	
	$data['country_code']= '';//$det[3];
	$data['mobile']='';//$det[4];
	$data['designation']= '';
	callUniversalAPI($data);
	print_r($det);
	//$data['booking_id']= '';
	//print_r($data);
	//exit;
	/*$sql = "SELECT * from it_2020_reg_api_log where email='" . $data['email'] . "'";
	$result = mysqli_query($link,$sql);
	if(mysqli_num_rows($result)) {
	} else {
		print_r($data);
		callUniversalAPI($data);
	}//
	//exit;
}

exit;*/

/*$sql = "SELECT * FROM it_2021_exhibitors_dir_payment_tbl where pin_no!='' ";
$resul = mysqli_query($link,$sql);
while($res = mysqli_fetch_assoc($resul)) {
	$sql = "SELECT * FROM " . $EVENT_DB_FORM_REG . " WHERE reg_id='ex" . $res['reg_id'] . "';";
	$result12 = mysqli_query($link,$sql);
	$result = mysqli_fetch_assoc($result12);//print_r($result);
	for ($i = 1; $i <= $result['sub_delegates']; $i++) {
		$dele_title      = $result['title' . $i];
		$dele_fname      = $result['fname' . $i];
		$dele_lname      = $result['lname' . $i];
		$dele_email      = $result['email' . $i];
		$job_title       = $result['job_title' . $i];
		$dele_cellno     = $result['cellno' . $i];
		$dele_cellno_arr = explode("-", $dele_cellno);

		if(isset($dele_cellno_arr[0])) {
			$country_code = $dele_cellno_arr[0];
			if(strlen($country_code) >= 6) {
				$phone = $country_code;
				$country_code = '+91';
			}
		}
		if(isset($dele_cellno_arr[1])) {
			$phone = $dele_cellno_arr[1];
		}
		//Call save Operator API
		$data = array();
		$data['name']= $dele_title . ' ' . $dele_fname . ' ' . $dele_lname;
		$data['email_id']= $dele_email;
		$data['country_code']= $country_code;
		$data['mobile']= $phone;
		$data['company']= $result['org'];
		$data['designation']= $job_title;
		$data['type']= 1;
		
		$sql = "SELECT * FROM it_2021_reg_api_log WHERE email='" . $dele_email . "';";
		$resgt = mysqli_query($link,$sql);
		
		if(mysqli_num_rows($resgt) <= 0) {
			if($result['cata' . $i] == 'Conference Delegate') {
				$data['category_id']= 113;
				//callUniversalAPI($data);
			} else {
				$data['category_id']= 114;
				//callUniversalAPI($data);
			}
			print_r($data);echo $result['cata' . $i] . $result['tin_no'] . '#' . mysqli_num_rows($resgt) . ' <br/>';
		}
	}
}
exit;*/

/*$sql = "SELECT * FROM `it_2021_reg_api_log` WHERE response LIKE '%504 Gateway%';";
$sql = "SELECT * FROM `it_2021_reg_api_log` WHERE ISNULL(response)";
$result = mysqli_query($link,$sql);
while($res = mysqli_fetch_assoc($result)) {
	$d = json_decode($res['request'], true);
	$resp = callUniversalAPI($d);
	print_r($d);
	print_r($resp);
}

exit;*/
/*$sql = "SELECT * FROM it_2019_reg_tbl WHERE tin_no='TIN-IT2019-139177815'";
$sql = "SELECT * FROM it_2019_reg_tbl WHERE cata ='Complimentary GIA Partner Delegate';";
$sql = "SELECT * FROM it_2019_reg_tbl WHERE pay_status='Complimentary';";*/
$sql = "SELECT * FROM it_2021_reg_tbl WHERE pay_status='Paid';";
$sql = "SELECT * FROM it_2021_reg_tbl WHERE pay_status='Free';";
$result = mysqli_query($link,$sql);

while($res = mysqli_fetch_assoc($result)) {
	for ($i = 1; $i <= $res['sub_delegates']; $i++) {
		$dele_title      = $res['title' . $i];
		$dele_fname      = $res['fname' . $i];
		$dele_lname      = $res['lname' . $i];
		$dele_email      = $res['email' . $i];
		$job_title       = $res['job_title' . $i];
		$dele_cellno     = $res['cellno' . $i];
		$dele_cellno_arr = explode("-", $dele_cellno);

		if(isset($dele_cellno_arr[0])) {
			$country_code = $dele_cellno_arr[0];
			if(strlen($country_code) >= 6) {
				$phone = $country_code;
				$country_code = '+91';
			}
		}
		if(isset($dele_cellno_arr[1])) {
			$phone = $dele_cellno_arr[1];
		}
		//Call save Operator API
		$data = array();
		$data['name']= $dele_title . ' ' . $dele_fname . ' ' . $dele_lname;
		$data['email_id']= $dele_email;
		$data['country_code']= $country_code;
		$data['mobile']= $phone;
		$data['company']= str_replace("'", "", $res['org']);
		$data['designation']= str_replace("'", "", $job_title);
		$data['type']= 1;
		
		//$data['booking_id']= $res['tin_no'];
		//$data['additional_data_1']= $res['assoc_name'];
		//$data['additional_data_2']= $res['city'];
		//$data['additional_data_3']= $res['state'];
		//Call API
		//callUniversalAPI($data);

		$sql = "SELECT * FROM it_2021_reg_api_log WHERE email='" . $dele_email . "';";
		$result12 = mysqli_query($link,$sql);
		
		if(mysqli_num_rows($result12) <= 0) {
			if($res['cata' . $i] == 'Conference Delegate') {
				$data['category_id']= 113;
				$resp = callUniversalAPI($data);
			} else {
				$data['category_id']= 114;
				$resp = callUniversalAPI($data);
			}
			echo $resp;
			print_r($data);echo $res['tin_no'] . ' <br/>';
		}
	}

	//$recordData[] = $row;
}
exit;

//print_r($recordData);
foreach($recordData as $res) {
	for ($i = 1; $i <= $res['sub_delegates']; $i++) {
		$dele_title      = $res['title' . $i];
		$dele_fname      = $res['fname' . $i];
		$dele_lname      = $res['lname' . $i];
		$dele_email      = $res['email' . $i];
		$job_title       = $res['job_title' . $i];
		$dele_cellno     = $res['cellno' . $i];
		$dele_cellno_arr = explode("-", $dele_cellno);

		if(isset($dele_cellno_arr[0])) {
			$country_code = $dele_cellno_arr[0];
			if(strlen($country_code) >= 6) {
				$phone = $country_code;
				$country_code = '+91';
			}
		}
		if(isset($dele_cellno_arr[1])) {
			$phone = $dele_cellno_arr[1];
		}
		//Call save Operator API
		$data = array();
		$data['name']= $dele_title . ' ' . $dele_fname . ' ' . $dele_lname;
		$data['email_id']= $dele_email;
		$data['country_code']= $country_code;
		$data['mobile']= $phone;
		$data['company']= $res['org'];
		$data['designation']= $job_title;
		$data['type']= 1;
		
		//$data['booking_id']= $res['tin_no'];
		//$data['additional_data_1']= $res['assoc_name'];
		//$data['additional_data_2']= $res['city'];
		//$data['additional_data_3']= $res['state'];
		//Call API
		//callUniversalAPI($data);
		if($res['cata' . $i] == 'Conference Delegate') {
			$data['category_id']= 113;
			callUniversalAPI($data);
		} else {
			$data['category_id']= 114;
			callUniversalAPI($data);
		}
	}
}
exit;

foreach($recordData as $row) {
	//for($i = 1; $i<= $row['sub_delegates']; $i++) {
		$data = array();
		$data['name']= $row['title'] . ' ' . $row['fname'] . ' ' . $row['lname'];
		$data['email']= $row['email'];
		/*$dele_cellno_arr = explode("-", $row['mob']);
	            
		if(isset($dele_cellno_arr[0])) {
			$country_code = $dele_cellno_arr[0];
			if(strlen($country_code) >= 6) {
				$phone = $country_code;
				$country_code = '+91';
			}
		}
		if(isset($dele_cellno_arr[1])) {
			$phone = $dele_cellno_arr[1];
		}*/

		$data['country_code']= '91';
		$data['phone']= $row['mob'];
		$data['company']= $row['org'];
		$data['designation']= (empty($row['desig']) ? '-' : $row['desig']);
		/*$data['additional_data_1']= $row['assoc_name'];
		$data['additional_data_2']= $row['city'];
		$data['additional_data_3']= $row['state'];*/
		$data['booking_id']= $row['exhibitor_id'];
		
		print_r($data);

		$res = $row;
		
		/*if($res['cata'] == 'Complimentary GIA Partner Delegate') {
			callUniversalAPI($data, 31422, 'GIA Partner');
			print_r($data);echo 'Complimentary GIA Partner Delegate';
		} else if($res['cata'] == 'Complimentary Media Delegate') {
			callUniversalAPI($data, 31426, 'Media');
			print_r($data);echo 'Complimentary Media Delegate';
		} else if($res['cata'] == 'Complimentary Sponsor Delegate') {
			callUniversalAPI($data, 31428, 'Sponsor');
			print_r($data);echo 'Complimentary Sponsor Delegate';
		} else if($res['cata'] == 'Complimentary Speaker Delegate') {
			callUniversalAPI($data, 31424, 'Speaker');
			print_r($data);echo 'Complimentary Speaker Delegate';
		} else if(($res['assoc_name'] == 'Nasscom')||($res['assoc_name'] == 'ABLE')||($res['assoc_name'] == 'ABAI')||($res['assoc_name'] == 'COAI')||($res['assoc_name'] == 'CLIK')||($res['assoc_name'] == 'RCI')||($res['assoc_name'] == 'TiE')||($res['assoc_name'] == 'IACC')||($res['assoc_name'] == 'IESA')||($res['assoc_name'] == 'MOBILE10X')||($res['assoc_name'] == 'Drone Federation of India')) {
			callUniversalAPI($data, 31427, 'Association Partner');
			print_r($data);echo 'Complimentary Association Partner Delegate';
		} else {
			if($res['org_reg_type'] == 'Poster'){
				callUniversalAPI($data, 31423, 'Poster');
				print_r($data);echo 'Poster Delegate';
			} else {
				callUniversalAPI($data, 31036, 'Delegate');
				print_r($data);echo 'Delegate';
			}
		}*/
		callUniversalAPI($data,31429,'Exhibitor');
	//}
}



/*$sql = "SELECT * FROM it_2019_speakers_directory_data_tbl";
$result = mysqli_query($link,$sql);
while($row = mysqli_fetch_assoc($result)) {
	$recordData[] = $row;
}
foreach($recordData as $row) {
	
		$data = array();
		$data['name']= $row['speaker_title'] . ' ' . $row['speaker_fname'] .' '.$row['speaker_mname'].' ' . $row['speaker_lname'];
		$data['email']= $row['speaker_email_1'];
		$data['country_code']= $row['speaker_mob_cntry_code'];
		$data['phone']= $row['speaker_mob'];
		$data['company']= $row['speaker_org'];
		$data['designation']= (empty($row['speaker_desig']) ? '-' : $row['speaker_desig' ]);
		$data['booking_id']= $row['speaker_id'];
		print_r($data);
		
			callUniversalAPI($data, 31424, 'Speaker');
}

exit;*/

/*$data['name']= 'Mr. Arindam Ray' ;
$data['email']= 'arindam.r@aqbsolutions.com';
$data['country_code']= '91';
$data['phone']='9831934645';
$data['company']= 'AQB Solutions Private Limited';
$data['designation']= '';
$data['booking_id']= '';
print_r($data);
exit;
callUniversalAPI($data, 31429, 'Exhibitor');
exit;*/


//echo $result;

 

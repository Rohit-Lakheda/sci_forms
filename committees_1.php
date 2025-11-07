<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>SCI2025 Committees</title>
</head>
<body id="committees-page">
    <?php include 'include/header.php'; ?>

	<link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Titillium+Web:ital,wght@0,400;0,600;0,700;0,900;1,300&display=swap" rel="stylesheet">
        
    <!-- Vendor CSS Stylesheet CDN path -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">

    <!-- Style CSS File -->
    <link href="https://sci25expo.supercomputingindia.org/assets/css/main.css?v=<?php echo time(); ?>" rel="stylesheet" />

	<style>
		.page-header-bg  {
			margin-top: 80px;
		}
		.steering-photo {
			width: 140px;
			height: 140px;
			object-fit: cover;
			border-radius: 50%;
			border: 4px solid var(--yellow);
		}
		.steering-name {
			font-size: 1.1rem;
			font-weight: 600;
			color: var(--yellow);
		}
		.steering-role {
			font-size: 0.95rem;
			color: #ccc;
		}
		.m-profile-photo {
			width: 140px; height: 140px;
			border: 4px solid var(--yellow);
			object-fit: cover;
			object-position: center;
		}
		.profile-modal .bio-content {
			max-height: 60vh;
			overflow-y: auto;
			padding-top: 0px;
			padding-bottom: 0px;
		}
		.profile-modal .btn-close {
			filter: invert(100%) sepia(0%) saturate(6929%) hue-rotate(200deg) brightness(200%) contrast(100%);
			position: absolute;
			right: 20px;
			top: 14px;
			border: 1px solid #000;
			height: 30px;
			width: 30px;
		}
		.profile-modal .modal-content {
			border: 3px solid var(--yellow);
		}
		.profile-modal .modal-header {
			display: flex;
			align-items: start;
			width: 100%;
		}
		.profile-modal .modal-header .pro-img {
			margin-right: 16px;
		}
		.profile-modal .modal-header .modal-title {
			font-size: 2rem;
			text-align: left;
			width: 100%;
		}
		.profile-modal .modal-header p {
			font-size: 1.1rem;
		}

		/* `lg` applies to medium devices (tablets, less than 992px) */
		@media (max-width: 991.98px) {
			.profile-modal .modal-header .modal-title {
				font-size: 1.6rem;
			}
		}
		@media (max-width: 767.98px) {
			.profile-modal .modal-header {
				flex-direction: column;
			}
			.profile-modal .modal-header .pro-img {
				margin-right: 0px;
				margin-bottom: 10px;
			}
			.m-profile-photo {
				position: relative;
				left: 0;
				right: auto;
			}
			.bio-content {
				padding-top: 1rem;
			}
			p {
				text-align: left;
			}
		}
		.navbar-dark .container {
			width: 100%;
			max-width: 100%;
		}
		@media (min-width: 576px) {
			.container {
				max-width: 540px;
			}
		}
		@media (min-width: 768px) {
			.container {
				max-width: 720px;
			}
		}
		@media (min-width: 992px) {
			.container {
				max-width: 960px;
			}
		}
		@media (min-width: 1200px) {
			.container {
				max-width: 1140px;
			}
		}
		@media (min-width: 1400px) {
			.container {
				max-width: 1320px;
			}
		}
	</style>

	<section class="page-header-bg org-page-header">
		<div class="container">
			<div class="row">
				<div class="col-md-12 col-lg-12">
					<h2 class="text-center">Committees</h2>
				</div>
			</div>
		</div>
	</section>

	<section class="hp-speakers-sec pb-0">
		<div class="container">
			<div class="row">
				<div class="col-md-12 col-lg-9 mx-auto text-center" data-aos="fade-up" data-aos-delay="400">
					<h2 class="section-title text-blue">Committee Members 2025</h2>
				</div>
			</div>
			<div class="row justify-content-center">
				<div class="col-md-4 col-lg-3 text-center" data-aos="zoom-in-up" data-aos-delay="300">
					<div class="speaker-card">
						<div class="speaker-img">
							<img src="assets-new/img/speakers/EMagesh.jpg?v=<?php echo time(); ?>" alt="Mr. E. Magesh" class="img-fluid steering-photo" data-bs-toggle="modal" data-bs-target="#profileModal" data-name="Mr. E Magesh" data-role="General Chair" data-affiliation="Director General, C-DAC" data-bio="Mr. E. Magesh is the Director General of C-DAC, the Center for Development of Advanced Computing. He is leading the organization's efforts in national mission programs related to supercomputing, microprocessor development, and other advanced computing areas like AI, Cyber Security, and Quantum Computing. He also emphasizes C-DAC's role in transforming innovative outcomes from Lab to Land through collaborations with industry and academia. ">
						</div>
						<div class="speaker-details">
							<p class="keynote">General Chair</p>
							<h5>Mr. E Magesh</h5>
							<p class="desc">Director General, C-DAC</p>
						</div>
					</div>
				</div>
				<div class="col-md-4 col-lg-3 text-center" data-aos="zoom-in-up" data-aos-delay="300">
					<div class="speaker-card">
						<div class="speaker-img">
							<!-- <img src="assets-new/img/speakers/SunitaVerma.jpg?v=<?php echo time(); ?>?v=<?php echo time(); ?>" alt="Ms. Sunita Verma" class="img-fluid" /> -->
							<img src="assets-new/img/speakers/SunitaVerma.jpg?v=<?php echo time(); ?>?v=<?php echo time(); ?>" class="steering-photo" data-bs-toggle="modal" data-bs-target="#profileModal" data-name="Ms. Sunita Verma" data-role="General Co-Chair" data-affiliation="Scientist G &amp; Group Coordinator, MeitY" data-bio="Ms. Sunita Verma is a senior scientist and currently serves as the Group Coordinator and Scientist 'G' in the Ministry of Electronics and Information Technology (MeitY), Government of India. She has played a pivotal role in formulating and implementing national policies and programs in areas such as High Performance Computing (HPC), Cyber Security, Quantum Technologies, Artificial Intelligence (AI), and Next Generation Networks.
								With extensive experience in strategic R&amp;D planning, Ms. Verma has led several key initiatives aimed at strengthening India's digital infrastructure and technological self-reliance. She has been instrumental in fostering public-private-academic partnerships and promoting indigenous technology development across emerging domains.
								Her contributions continue to influence national missions, including National Supercomputing Mission (NSM), National Quantum Mission, and initiatives under Digital India.">
						</div>
						<div class="speaker-details">
							<p class="keynote">General Co-Chair</p>
							<h5>Ms. Sunita Verma</h5>
							<p class="desc">Scientist G & Group Coordinator MeitY</p>
						</div>
					</div>
				</div>
			</div>
			<div class="row justify-content-center">
				<div class="col-md-4 col-lg-3 text-center" data-aos="zoom-in-up" data-aos-delay="300">
					<div class="speaker-card">
						<div class="speaker-img">
							<img src="assets-new/img/speakers/SameerShende.jpg?v=<?php echo time(); ?>" 
								alt="Prof. Sameer Shende"
								class="steering-photo"
								data-bs-toggle="modal"
								data-bs-target="#profileModal"
								data-name="Prof. Sameer Shende"
								data-role="Technical Programme Committee Chair"
								data-affiliation="University of Oregon, USA"
								data-bio="">
						</div>
						<div class="speaker-details">
							<p class="keynote">Technical Programme Committee<br> Chair</p>
							<h5>Prof. Sameer Shende</h5>
							<p class="desc">University of Oregon, USA</p>
						</div>
					</div>
				</div>
				<div class="col-md-4 col-lg-3 text-center" data-aos="zoom-in-up" data-aos-delay="300">
					<div class="speaker-card">
						<div class="speaker-img">
							<img src="assets-new/img/speakers/HemantDarbari.jpg?v=<?php echo time(); ?>"
								alt="Dr. Hemant Darbari"
								class="steering-photo"
								data-bs-toggle="modal"
								data-bs-target="#profileModal"
								data-name="Dr. Hemant Darbari"
								data-role="Technical Programme Committee Co-Chair"
								data-affiliation="C-DAC, India"
								data-bio="">
						</div>
						<div class="speaker-details">
							<p class="keynote">Technical Programme Committee<br> Co-Chair</p>
							<h5>Dr. Hemant Darbari</h5>
							<p class="desc">C-DAC, India</p>
						</div>
					</div>
				</div>
			</div>
			<div class="row justify-content-center">
				<div class="col-md-4 col-lg-3 text-center" data-aos="zoom-in-up" data-aos-delay="300">
					<div class="speaker-card">
						<div class="speaker-img">
							<img src="assets-new/img/speakers/SeethaRamaKrishna.png?v=<?php echo time(); ?>"
								alt="Mr. Seetha Rama Krishna"
								class="steering-photo"
								data-bs-toggle="modal"
								data-bs-target="#profileModal"
								data-name="Mr. Seetha Rama Krishna"
								data-role="Organizing Chair"
								data-affiliation="Director Asia Pacific & Japan - HPC, Intel"
								data-bio="">
						</div>
						<div class="speaker-details">
							<p class="keynote">Organizing Chair</p>
							<h5>Mr. Seetha Rama Krishna</h5>
							<p class="desc">Director Asia Pacific & Japan - HPC, Intel</p>
						</div>
					</div>
				</div>
				<div class="col-md-4 col-lg-3 text-center" data-aos="zoom-in-up" data-aos-delay="300">
					<div class="speaker-card">
						<div class="speaker-img">
							<img src="assets-new/img/speakers/SDSudarsan.jpg?v=<?php echo time(); ?>"
								alt="Dr. S. D. Sudarsan"
								class="steering-photo"
								data-bs-toggle="modal"
								data-bs-target="#profileModal"
								data-name="Dr. S. D. Sudarsan"
								data-role="Organizing Co-Chair"
								data-affiliation="C-DAC, India"
								data-bio="">
						</div>
						<div class="speaker-details">
							<p class="keynote">Organizing Co-Chair</p>
							<h5>Dr. S. D. Sudarsan</h5>
							<p class="desc">Executive Director, C-DAC, Bengaluru</p>
						</div>
					</div>
				</div>
			</div>
			<div class="row justify-content-center">
				<div class="col-md-4 col-lg-3 text-center" data-aos="zoom-in-up" data-aos-delay="300">
					<div class="speaker-card">
						<div class="speaker-img">
							<img src="assets-new/img/speakers/PrashantMisra.jpg?v=<?php echo time(); ?>"
								alt="Dr. Prashant Misra"
								class="steering-photo"
								data-bs-toggle="modal"
								data-bs-target="#profileModal"
								data-name="Dr. Prashant Misra"
								data-role="Industry Workshop Chair"
								data-affiliation="TCS Research"
								data-bio="">
						</div>
						<div class="speaker-details">
							<p class="keynote">Industry Workshop<br> Chair</p>
							<h5>Dr. Prashant Misra</h5>
							<p class="desc">TCS Research</p>
						</div>
					</div>
				</div>
				<div class="col-md-4 col-lg-3 text-center" data-aos="zoom-in-up" data-aos-delay="300">
					<div class="speaker-card">
						<div class="speaker-img">
							<img src="assets-new/img/speakers/SunilKumarVuppala.jpg?v=<?php echo time(); ?>"
								alt="Dr. Sunil Kumar Vuppala"
								class="steering-photo"
								data-bs-toggle="modal"
								data-bs-target="#profileModal"
								data-name="Dr. Sunil Kumar Vuppala"
								data-role="Technical Programme Committee Co-Chair"
								data-affiliation="Aurigo"
								data-bio="">
						</div>
						<div class="speaker-details">
							<p class="keynote">Industry Workshop <br> Co-Chair</p>
							<h5>Dr. Sunil Kumar Vuppala</h5>
							<p class="desc">Aurigo</p>
						</div>
					</div>
				</div>
			</div>
			<div class="row justify-content-center">
				<div class="col-md-4 col-lg-3 text-center" data-aos="zoom-in-up" data-aos-delay="300">
					<div class="speaker-card">
						<div class="speaker-img">
							<img src="assets-new/img/speakers/RajendraJoshi.jpg?v=<?php echo time(); ?>"
								alt="Dr. Rajendra Joshi"
								class="steering-photo"
								data-bs-toggle="modal"
								data-bs-target="#profileModal"
								data-name="Dr. Rajendra Joshi"
								data-role="Publicity Chair"
								data-affiliation="Mission Coordinator,||National Supercomputing Mission,|| NSM-Mission Directorate,||C-DAC Innovation Park, Pune"
								data-bio="Dr. Rajendra Joshi holds a Doctorate in Biochemistry from National Chemical Laboratory (University of Pune). He has over 30 years of experience in the area of Bioinformatics, which includes experience as a faculty member at the Bioinformatics Centre, University of Pune. He is primarily responsible for building a strong bioinformatics group at C-DAC and served as a Senior Director and Head of the Department of the High Performance Computing: Medical and Bioinformatics Applications Group (HPC-M&BA), at C-DAC. He served as the convener of the Expert Group on Applications Development of the National Supercomputing Mission of the Government of India. His work has resulted in more than 100 publications in high-impact, internationally peer-reviewed journals, reflecting his broad and influential contributions to the scientific community. He is presently serving as the Mission Coordinator of the National Supercomputing Mission at the NSM-Mission Directorate, C-DAC, Pune.">
						</div>
						<div class="speaker-details">
							<p class="keynote">Publicity Chair</p>
							<h5>Dr. Rajendra Joshi</h5>
							<p class="desc">C-DAC</p>
						</div>
					</div>
				</div>
				<div class="col-md-4 col-lg-3 text-center" data-aos="zoom-in-up" data-aos-delay="300">
					<div class="speaker-card">
						<div class="speaker-img">
							<img src="assets-new/img/speakers/MohammedMishbauddin.jpg?v=<?php echo time(); ?>"
								alt="Dr. Mohammed Mishbauddin"
								class="steering-photo"
								data-bs-toggle="modal"
								data-bs-target="#profileModal"
								data-name="Dr. Mohammed Mishbauddin"
								data-role="Publication Chair"
								data-affiliation="Scientist 'F',||C-DAC Bengaluru ||India"
								data-bio="">
						</div>
						<div class="speaker-details">
							<p class="keynote">Publication Chair</p>
							<h5>Dr. Mohammed Mishbauddin</h5>
							<p class="desc">C-DAC</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<section class="hp-speakers-sec bg-white" id="track-co-chairs">
		<div class="container">
			<div class="row">
				<div class="col-md-12 col-lg-9 mx-auto text-center" data-aos="fade-up" data-aos-delay="400">
					<h2 class="section-title text-blue">Track Co-Chairs</h2>
				</div>
			</div>
			<div class="row justify-content-center">
				<div class="col-md-4 col-lg-3 text-center" data-aos="zoom-in-up" data-aos-delay="300">
					<div class="speaker-card">
						<div class="speaker-img">
							<img src="assets-new/img/speakers/FelixWolf.jpg?v=<?php echo time(); ?>"
								alt="Prof. Felix Wolf"
								class="steering-photo"
								data-bs-toggle="modal"
								data-bs-target="#profileModal"
								data-name="Prof. Felix Wolf"
								data-role="Performance"
								data-affiliation="TU Darmstadt, Germany"
								data-bio="">
						</div>
						<div class="speaker-details">
							<p class="keynote">Performance</p>
							<h5>Prof. Felix Wolf</h5>
							<p class="desc">TU Darmstadt, Germany</p>
						</div>
					</div>
				</div>
				<div class="col-md-4 col-lg-3 text-center" data-aos="zoom-in-up" data-aos-delay="300">
					<div class="speaker-card">
						<div class="speaker-img">
							<img src="assets-new/img/speakers/SwaroopPophale.jpg?v=<?php echo time(); ?>"
								alt="Dr. Swaroop Pophale"
								class="steering-photo"
								data-bs-toggle="modal"
								data-bs-target="#profileModal"
								data-name="Dr. Swaroop Pophale"
								data-role="Performance"
								data-affiliation="ORNL, USA"
								data-bio="">
						</div>
						<div class="speaker-details">
							<p class="keynote">Performance</p>
							<h5>Dr. Swaroop Pophale</h5>
							<p class="desc">ORNL, USA</p>
						</div>
					</div>
				</div>
			</div>
			<div class="row justify-content-center">
				<div class="col-md-4 col-lg-3 text-center" data-aos="zoom-in-up" data-aos-delay="300">
					<div class="speaker-card">
						<div class="speaker-img">
							<img src="assets-new/img/speakers/DKPanda.jpg?v=<?php echo time(); ?>"
								alt="Prof. DK Panda"
								class="steering-photo"
								data-bs-toggle="modal"
								data-bs-target="#profileModal"
								data-name="Prof. DK Panda"
								data-role="Organizing Chair"
								data-affiliation="OSU, USA"
								data-bio="">
						</div>
						<div class="speaker-details">
							<p class="keynote">Programming Environments</p>
							<h5>Prof. DK Panda</h5>
							<p class="desc">OSU, USA</p>
						</div>
					</div>
				</div>
				<div class="col-md-4 col-lg-3 text-center" data-aos="zoom-in-up" data-aos-delay="300">
					<div class="speaker-card">
						<div class="speaker-img">
							<img src="assets-new/img/speakers/AnjaniPriyadarshini.jpg?v=<?php echo time(); ?>"
								alt="Dr. Anjani Priyadarshini"
								class="steering-photo"
								data-bs-toggle="modal"
								data-bs-target="#profileModal"
								data-name="Dr. Anjani Priyadarshini"
								data-role="Programming Environments||Track Co-Chair"
								data-affiliation="Quantum Computing Lead ||AWS India"
								data-bio="Dr. Anjani Priya, a quantum physicist with a PhD from IISc, leads AWS India's Quantum Computing business and drives HPC and Research for the Public sector.
								Dr. Priya's journey began as a software engineer at Infosys before earning her PhD from the Indian Institute of Science. As a former Technical Lead at Sohum Innovation Lab, she led the development of an indigenous hearing screening device for new-borns, for which the team earned the National Award. Later, she worked as a Computation & Algorithmic Specialist in Quantum at Robert Bosch.
								She predominantly works in computational mathematics and quantum algorithms. In the field of quantum, her expertise was primarily focused on algorithmic specialization across various domains, encompassing the automotive industry, aerospace, robotics, drones, computational fluid dynamics (CFD), finance, supply chain management, factory optimization, agriculture, materials science, drug discovery, and many others.">
						</div>
						<div class="speaker-details">
							<p class="keynote">Programming Environments</p>
							<h5>Dr. Anjani Priyadarshini</h5>
							<p class="desc">AWS India</p>
						</div>
					</div>
				</div>
			</div>
			<div class="row justify-content-center">
				<div class="col-md-4 col-lg-3 text-center" data-aos="zoom-in-up" data-aos-delay="300">
					<div class="speaker-card">
						<div class="speaker-img">
							<img src="assets-new/img/speakers/JeffHammond.jpg?v=<?php echo time(); ?>"
								alt="Dr. Jeff Hammond"
								class="steering-photo"
								data-bs-toggle="modal"
								data-bs-target="#profileModal"
								data-name="Dr. Jeff Hammond"
								data-role="Multidisciplinary||Track Co-Chair"
								data-affiliation="Principal Engineer,||NVIDIA Helsinki Oy"
								data-bio="Jeff Hammond is a Principal Engineer at NVIDIA, focused on GPU communication software.  He has extensive experience with the design and use of parallel programming models and scientific applications.  Jeff has worked on HPC software for almost 20 years.  His most notable achievements include the MPI-5 Application Binary Interface standard, development of the MPI-3 one-sided communication software ecosystem, and contributions to the NWChem quantum chemistry project.  Jeff received a PhD in Chemistry from the University of Chicago.">
						</div>
						<div class="speaker-details">
							<p class="keynote">Multidisciplinary</p>
							<h5>Dr. Jeff Hammond</h5>
							<p class="desc">Principal Engineer, NVIDIA Helsinki Oy</p>
						</div>
					</div>
				</div>
				<div class="col-md-4 col-lg-3 text-center" data-aos="zoom-in-up" data-aos-delay="300">
					<div class="speaker-card">
						<div class="speaker-img">
							<img src="assets-new/img/speakers/LaxmikantKale.jpg?v=<?php echo time(); ?>"
								alt="Prof. Laxmikant Kale"
								class="steering-photo"
								style="object-fit: cover; object-position: 65% center; width: 140px; height: 140px; border-radius: 50%;"
								data-bs-toggle="modal"
								data-bs-target="#profileModal"
								data-name="Prof. Laxmikant (Sanjay) Kale"
								data-role="Multidisciplinary"
								data-affiliation="Paul and Cynthia Saylor Professor Emeritus of Computer Science,<br> Siebel School of Computer Science, University of Illinois at<br> Urbana-Champaign"
								data-bio="Professor Laxmikant Kale is Research Professor, and the Paul and Cynthia Saylor Professor Emeritus of Computer Science at the University of Illinois at Urbana-Champaign.
								Prof. Kale has been working on various aspects of parallel computing, with a focus on enhancing performance and productivity via adaptive runtime systems, and with the belief that only interdisciplinary research involving multiple application domains can bring back well-honed abstractions into Computer Science that can have a long-term impact on the state-of-art.
								His numerous interdisciplinary collaborations include the widely used Gordon-Bell award winning biomolecular simulation program NAMD.  He takes pride in his group's success in distributing and supporting software embodying his research ideas, including Charm++, Adaptive MPI and Charm4Py. He and his team won the HPC Challenge award at Supercomputing 2011, for Charm++.  Prof. Kale is a fellow of the ACM and IEEE, and a winner of the 2012 IEEE Sidney Fernbach award.">
						</div>
						<div class="speaker-details">
							<p class="keynote">Multidisciplinary</p>
							<h5>Prof. Laxmikant Kale</h5>
							<p class="desc">UIUC, USA</p>
						</div>
					</div>
				</div>
			</div>
			<div class="row justify-content-center">
				<div class="col-md-4 col-lg-3 text-center" data-aos="zoom-in-up" data-aos-delay="300">
					<div class="speaker-card">
						<div class="speaker-img">
							<img src="assets-new/img/speakers/ManishParashar.jpg?v=<?php echo time(); ?>"
								alt="Prof. Manish Parashar"
								class="steering-photo"
								data-bs-toggle="modal"
								data-bs-target="#profileModal"
								data-name="Prof. Manish Parashar"
								data-role="Applications"
								data-affiliation="Chief AI Officer||Director, Scientific Computing and Imaging (SCI) Institute ||Presidential Professor, Kahlert School of Computing||University of Utah, USA"
								data-bio="Manish Parashar is the inaugural Chief AI Officer at the University of Utah. He is also Executive Director of the Scientific Computing and Imaging (SCI) Institute, and Presidential Professor in the Kalhert School of Computing. He leads the University’s One-U Responsible AI Initiative.
								Manish’s expertise is in high-performance parallel and distributed computing and cyberinfrastructure, and his research has enabled new insights across multiple science domains.
								Manish has received several awards for his research and leadership, including the 2023 IEEE Computer Society Sidney Fernbach Award, the 2024 CRA Distinguished Service Award, and the 2025 ACM Distinguished Service Award. Manish is a Fellow of AAAS, ACM, and IEEE.">
						</div>
						<div class="speaker-details">
							<p class="keynote">Applications</p>
							<h5>Prof. Manish Parashar</h5>
							<p class="desc">University of Utah, USA</p>
						</div>
					</div>
				</div>
				<div class="col-md-4 col-lg-3 text-center" data-aos="zoom-in-up" data-aos-delay="300">
					<div class="speaker-card">
						<div class="speaker-img">
							<img src="assets-new/img/speakers/YogeshSimmhan.jpg?v=<?php echo time(); ?>"
								alt="Prof. Yogesh Simmhan"
								class="steering-photo"
								data-bs-toggle="modal"
								data-bs-target="#profileModal"
								data-name="Prof. Yogesh Simmhan"
								data-role="Applications"
								data-affiliation="IISc, India"
								data-bio="">
						</div>
						<div class="speaker-details">
							<p class="keynote">Applications</p>
							<h5>Prof. Yogesh Simmhan</h5>
							<p class="desc">IISc, India</p>
						</div>
					</div>
				</div>
			</div>
			<div class="row justify-content-center">
				<div class="col-md-4 col-lg-3 text-center" data-aos="zoom-in-up" data-aos-delay="300">
					<div class="speaker-card">
						<div class="speaker-img">
							<img src="assets-new/img/speakers/RajkumarBuyya.jpeg?v=<?php echo time(); ?>"
								alt="Prof. Rajkumar Buyya"
								class="steering-photo"
								data-bs-toggle="modal"
								data-bs-target="#profileModal"
								data-name="Prof. Rajkumar Buyya"
								data-role="Cloud and Distributed HPC"
								data-affiliation="University of Melbourne, Australia"
								data-bio="Dr. Rajkumar Buyya is a Redmond Barry Distinguished Professor and Director of the Quantum Cloud Computing and Distributed Systems (qCLOUDS) Laboratory at the University of Melbourne, Australia. He is also serving as the founding CEO of Manjrasoft, a spin-off company of the University, commercializing its innovations in Cloud Computing.">
						</div>
						<div class="speaker-details">
							<p class="keynote">Cloud and Distributed HPC</p>
							<h5>Prof. Rajkumar Buyya</h5>
							<p class="desc">University of Melbourne, Australia</p>
						</div>
					</div>
				</div>
				<div class="col-md-4 col-lg-3 text-center" data-aos="zoom-in-up" data-aos-delay="300">
					<div class="speaker-card">
						<div class="speaker-img">
							<img src="assets-new/img/speakers/SatishPuri.jpg?v=<?php echo time(); ?>"
								alt="Dr. Satish Puri"
								class="steering-photo"
								data-bs-toggle="modal"
								data-bs-target="#profileModal"
								data-name="Prof. Satish Puri"
								data-role="Cloud and Distributed HPC||Track Co-Chair"
								data-affiliation="Associate Professor,||Department of Computer Science,||Missouri University of Science and Technology,||Missouri, USA"
								data-bio="Dr. Satish Puri is an Associate Professor of Computer Science at Missouri S&T. He was an Assistant Professor at Marquette University, Wisconsin before joining Missouri S&T. His area of research is Parallel and Distributed Computing, Spatial Big Data, and High-Performance Computing. Current research interests are “Analytics on novel computer architectures”, “Nearest Neighbor Similarity Search” and heterogeneous computing using processing-in-memory paradigm. Satish teaches “Parallel Programming and Algorithms” and “Topics in Parallel and Distributed Computing”. His research has been supported currently by National Science Foundation OAC and NSF CAREER grants.">
						</div>
						<div class="speaker-details">
							<p class="keynote">Cloud and Distributed HPC</p>
							<h5>Dr. Satish Puri</h5>
							<p class="desc">Associate Professor,Missouri S&T, USA</p>
						</div>
					</div>
				</div>
			</div>
			<div class="row justify-content-center">
				<div class="col-md-4 col-lg-3 text-center" data-aos="zoom-in-up" data-aos-delay="300">
					<div class="speaker-card">
						<div class="speaker-img">
							<img src="assets-new/img/speakers/HariSundar.jpg?v=<?php echo time(); ?>"
								alt="Prof. Hari Sundar"
								class="steering-photo"
								data-bs-toggle="modal"
								data-bs-target="#profileModal"
								data-name="Prof. Hari Sundar"
								data-role="Algorithms"
								data-affiliation="Tufts University, USA"
								data-bio="">
						</div>
						<div class="speaker-details">
							<p class="keynote">Algorithms</p>
							<h5>Prof. Hari Sundar</h5>
							<p class="desc">Tufts University, USA</p>
						</div>
					</div>
				</div>
				<div class="col-md-4 col-lg-3 text-center" data-aos="zoom-in-up" data-aos-delay="300">
					<div class="speaker-card">
						<div class="speaker-img">
							<img src="assets-new/img/speakers/ManishModani.jpg?v=<?php echo time(); ?>"
								alt="Dr. Manish Modani "
								class="steering-photo"
								data-bs-toggle="modal"
								data-bs-target="#profileModal"
								data-name="Dr. Manish Modani"
								data-role="Algorithms||Track Co-Chair"
								data-affiliation="Principal Solution Architect,||NVIDIA"
								data-bio="Dr. Manish Modani is a Principal Solution Architect at NVIDIA, where he partners with academia, start-ups, and enterprises to design and scale advanced solutions in AI, HPC, and quantum technologies. Holding a PhD in Computational Science and Engineering, he brings over a decade of expertise in scientific computing, large-scale simulations, and AI infrastructure. Dr. Modani plays a key role in strengthening India’s AI and quantum innovation landscape through initiatives such as the LLM for Science program and the Quantum Ready Challenge. An alumnus of IIT Delhi, he is dedicated to translating deep research into real-world applications while fostering innovation through mentorship and strategic collaboration. His contributions have been recognized globally through peer-reviewed publications, books, and patents.">
						</div>
						<div class="speaker-details">
							<p class="keynote">Algorithms</p>
							<h5>Dr. Manish Modani</h5>
							<p class="desc">NVIDIA</p>
						</div>
					</div>
				</div>
			</div>
			<div class="row justify-content-center">
				<div class="col-md-4 col-lg-3 text-center" data-aos="zoom-in-up" data-aos-delay="300">
					<div class="speaker-card">
						<div class="speaker-img">
							<img src="assets-new/img/speakers/AnilPrabhakar.jpg?v=<?php echo time(); ?>"
								alt="Prof. Anil Prabhakar"
								class="steering-photo"
								data-bs-toggle="modal"
								data-bs-target="#profileModal"
								data-name="Prof. Anil Prabhakar"
								data-role="Quantum Computing||Track Co-Chair"
								data-affiliation="IIT Madras, India"
								data-bio="Prof. Anil Prabhakar joined the Dept. of Electrical Engineering at IIT Madras in 2002. He received his PhD in 1997 from Carnegie Mellon University with a dissertation on Nonlinear Spin-wave Optical Interactions. His current research interests are in the areas of quantum technologies with applications in metrology, quantum communication, and quantum computing. He is the Project Director for the National Quantum Mission Hub on Quantum Communications, and is a co-founder of QuNu Labs and Quanfluence, companies incubated by IIT Madras. Prof. Prabhakar has authored over 50 research publications and co-authored a book on Spin Waves. He holds 18 patents on a range of devices in the fields of photonics, magnonics, as well as assistive devices, and is on the Board of Editors of many international journals">
						</div>
						<div class="speaker-details">
							<p class="keynote">Quantum Computing</p>
							<h5>Prof. Anil Prabhakar</h5>
							<p class="desc">IIT Madras, India</p>
						</div>
					</div>
				</div>
				<div class="col-md-4 col-lg-3 text-center" data-aos="zoom-in-up" data-aos-delay="300">
					<div class="speaker-card">
						<div class="speaker-img">
							<img src="assets-new/img/speakers/AnastasiiaButko.jpg?v=<?php echo time(); ?>"
								alt="Dr. Anastasiia Butko"
								class="steering-photo"
								data-bs-toggle="modal"
								data-bs-target="#profileModal"
								data-name="Dr. Anastasiia Butko"
								data-role="Quantum Computing"
								data-affiliation="LBNL, USA"
								data-bio="">
						</div>
						<div class="speaker-details">
							<p class="keynote">Quantum Computing</p>
							<h5>Dr. Anastasiia Butko</h5>
							<p class="desc">LBNL, USA</p>
						</div>
					</div>
				</div>
			</div>
			<div class="row justify-content-center">
				<div class="col-md-4 col-lg-3 text-center" data-aos="zoom-in-up" data-aos-delay="300">
					<div class="speaker-card">
						<div class="speaker-img">
							<img src="assets-new/img/speakers/PrasannaBalaprakash.jpg?v=<?php echo time(); ?>"
								alt="Dr. Prasanna Balaprakash"
								class="steering-photo"
								data-bs-toggle="modal"
								data-bs-target="#profileModal"
								data-name="Dr. Prasanna Balaprakash"
								data-role="Artificial Intelligence (AI)"
								data-affiliation="ORNL, USA"
								data-bio="">
						</div>
						<div class="speaker-details">
							<p class="keynote">Artificial Intelligence (AI)</p>
							<h5>Dr. Prasanna Balaprakash</h5>
							<p class="desc">ORNL, USA</p>
						</div>
					</div>
				</div>
				<div class="col-md-4 col-lg-3 text-center" data-aos="zoom-in-up" data-aos-delay="300">
					<div class="speaker-card">
						<div class="speaker-img">
							<img src="assets-new/img/speakers/HarshitaMenon.jpg?v=<?php echo time(); ?>"
								alt="Dr. Harshita Menon"
								class="steering-photo"
								data-bs-toggle="modal"
								data-bs-target="#profileModal"
								data-name="Dr. Harshita Menon"
								data-role="Artificial Intelligence (AI)"
								data-affiliation="LLNL, USA"
								data-bio="">
						</div>
						<div class="speaker-details">
							<p class="keynote">Artificial Intelligence (AI)</p>
							<h5>Dr. Harshita Menon</h5>
							<p class="desc">LLNL, USA</p>
						</div>
					</div>
				</div>
			</div>
			<div class="row justify-content-center">
				<div class="col-md-4 col-lg-3 text-center" data-aos="zoom-in-up" data-aos-delay="300">
					<div class="speaker-card">
						<div class="speaker-img">
							<img src="assets-new/img/speakers/SmrutiRanjanSarangi.jpg?v=<?php echo time(); ?>"
								alt="Prof. Smruti Ranjan Sarangi"
								class="steering-photo"
								data-bs-toggle="modal"
								data-bs-target="#profileModal"
								data-name="Prof. Smruti Ranjan Sarangi"
								data-role="Architecture"
								data-affiliation="IIT Delhi, India"
								data-bio="">
						</div>
						<div class="speaker-details">
							<p class="keynote">Architecture</p>
							<h5>Prof. Smruti Ranjan Sarangi</h5>
							<p class="desc">IIT Delhi, India</p>
						</div>
					</div>
				</div>
				<div class="col-md-4 col-lg-3 text-center" data-aos="zoom-in-up" data-aos-delay="300">
					<div class="speaker-card">
						<div class="speaker-img">
							<img src="assets-new/img/speakers/PreetiMalakar.jpg?v=<?php echo time(); ?>"
								alt="Prof. Preeti Malakar"
								class="steering-photo"
								data-bs-toggle="modal"
								data-bs-target="#profileModal"
								data-name="Prof. Preeti Malakar"
								data-role="Architecture||Track Co-Chair"
								data-affiliation="Assistant Professor,||IIT Kanpur, India"
								data-bio="Preeti Malakar is an Assistant Professor in the Department of Computer Science and Engineering, Indian Institute of Technology Kanpur. Prior to this, she worked at the Argonne National Laboratory in the United States. She completed her PhD in the Department of Computer Science and Automation at the Indian Institute of Science, Bengaluru. Her research interests include scalable parallel communications, modelling and optimizing scientific workflows, parallel I/O, and application performance modelling/analysis.">
						</div>
						<div class="speaker-details">
							<p class="keynote">Architecture</p>
							<h5>Prof. Preeti Malakar</h5>
							<p class="desc">IIT Kanpur, India</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<section class="ptb-5 black-linear-gradient hp-pc-members-sec" id="track-pc-members">
		<div class="container">
			<div class="row">
				<div class="col-md-12 col-lg-9 mx-auto text-center">
					<h2 class="section-title text-white">Track PC Members</h2>
				</div>
			</div>
			<div class="row justify-content-center">
				<div class="col-md-12" id="main-section">
					<div class="accordion sci-accordion track-pc-members-accordion" id="sciAccordion">
						<!-- AI -->
						<div class="accordion-item">
							<div class="accordion-header" id="heading1">
								<h3 class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse1" aria-expanded="true" aria-controls="collapse1">AI (Artificial Intelligence)</h3>
							</div>
							<div id="collapse1" class="accordion-collapse collapse" aria-labelledby="heading1" data-bs-parent="#sciAccordion">
								<div class="accordion-body">
									<div class="row gy-4 alphabetically-first-name">
										<div class="col-md-6 col-lg-3">
											<div class="border-box scrollbar">
												<h5>Ana Gainaru</h5>
												<p>Oak Ridge National Laboratory (ORNL)</p>
											</div>
										</div>
										<div class="col-md-6 col-lg-3">
											<div class="border-box scrollbar">
												<h5>Anirban	Mandal</h5>
												<p>Renaissance Computing Institute (RENCI), University of North Carolina at Chapel Hill</p>
											</div>
										</div>
										<div class="col-md-6 col-lg-3">
											<div class="border-box scrollbar">
												<h5>Bhardwaj Kshitij</h5>
												<p>LLNL</p>
											</div>
										</div>
										<div class="col-md-6 col-lg-3">
											<div class="border-box scrollbar">
												<h5>Chowdhury Arindam</h5>
												<p>Oak Ridge National Laboratory</p>
											</div>
										</div>
										<div class="col-md-6 col-lg-3">
											<div class="border-box scrollbar">
												<h5>Daniel Nichols</h5>
												<p>Lawrence Livermore National Laboratory</p>
											</div>
										</div>
										<div class="col-md-6 col-lg-3">
											<div class="border-box scrollbar">
												<h5>Gal	Oren</h5>
												<p>Stanford University, Technion - Israel Institute of Technology, NRCN</p>
											</div>
										</div>
										<div class="col-md-6 col-lg-3">
											<div class="border-box scrollbar">
												<h5>Gautam Singh</h5>
												<p>Lawrence Livermore National Laboratory</p>
											</div>
										</div>
										<div class="col-md-6 col-lg-3">
											<div class="border-box scrollbar">
												<h5>George K. Thiruvathukal</h5>
												<p>Loyola University, Chicago; Argonne National Laboratory (ANL)</p>
											</div>
										</div>
										<div class="col-md-6 col-lg-3">
											<div class="border-box scrollbar">
												<h5>Hongwei	Jin</h5>
												<p>Argonne National Laboratory (ANL)</p>
											</div>
										</div>
										<div class="col-md-6 col-lg-3">
											<div class="border-box scrollbar">
												<h5>Huihuo Zheng</h5>
												<p>Argonne National Laboratory (ANL)</p>
											</div>
										</div>
										<div class="col-md-6 col-lg-3">
											<div class="border-box scrollbar">
												<h5>Krishnan Raghavan</h5>
												<p>Argonne National Laboratory (ANL)</p>
											</div>
										</div>
										<div class="col-md-6 col-lg-3">
											<div class="border-box scrollbar">
												<h5>Kshitij	Mehta</h5>
												<p>Oak Ridge National Laboratory (ORNL)</p>
											</div>
										</div>
										<div class="col-md-6 col-lg-3">
											<div class="border-box scrollbar">
												<h5>Lannie Hough</h5>
												<p>University of Maryland College Park</p>
											</div>
										</div>
										<div class="col-md-6 col-lg-3">
											<div class="border-box scrollbar">
												<h5>Li Chaojian</h5>
												<p>HKUST</p>
											</div>
										</div>
										<div class="col-md-6 col-lg-3">
											<div class="border-box scrollbar">
												<h5>Maria Mahbub</h5>
												<p>ORNL</p>
											</div>
										</div>
										<div class="col-md-6 col-lg-3">
											<div class="border-box scrollbar">
												<h5>Marieme Ngom</h5>
												<p>Argonne National Laboratory (ANL)</p>
											</div>
										</div>
										<div class="col-md-6 col-lg-3">
											<div class="border-box scrollbar">
												<h5>Massimiliano Lupo Pasini</h5>
												<p>Oak Ridge National Laboratory (ORNL)</p>
											</div>
										</div>
										<div class="col-md-6 col-lg-3">
											<div class="border-box scrollbar">
												<h5>Md Mahbubur Rahman</h5>
												<p>Iowa State University</p>
											</div>
										</div>
										<div class="col-md-6 col-lg-3">
											<div class="border-box scrollbar">
												<h5>Meghana	Madhyastha</h5>
												<p>John Hopkins University, Argonne National Laboratory</p>
											</div>
										</div>
										<div class="col-md-6 col-lg-3">
											<div class="border-box scrollbar">
												<h5>Mohammad Alaul Haque Monil</h5>
												<p>Oak Ridge National Laboratory (ORNL)</p>
											</div>
										</div>
										<div class="col-md-6 col-lg-3">
											<div class="border-box scrollbar">
												<h5>Murali Emani</h5>
												<p>Argonne National Laboratory (ANL)</p>
											</div>
										</div>
										<div class="col-md-6 col-lg-3">
											<div class="border-box scrollbar">
												<h5>Nikhil Jain</h5>
												<p>NVIDIA Corporation</p>
											</div>
										</div>
										<div class="col-md-6 col-lg-3">
											<div class="border-box scrollbar">
												<h5>Pedro	Valero-Lara</h5>
												<p>Oak Ridge National Laboratory (ORNL)</p>
											</div>
										</div>
										<div class="col-md-6 col-lg-3">
											<div class="border-box scrollbar">
												<h5>Ponnuswamy Sadayappan</h5>
												<p>University of Utah, Pacific Northwest National Laboratory (PNNL)</p>
											</div>
										</div>
										<div class="col-md-6 col-lg-3">
											<div class="border-box scrollbar">
												<h5>Prajwal Singhania</h5>
												<p>University of Maryland</p>
											</div>
										</div>
										<div class="col-md-6 col-lg-3">
											<div class="border-box scrollbar">
												<h5>Qian Gong</h5>
												<p>Oak Ridge National Laboratory (ORNL)</p>
											</div>
										</div>
										<div class="col-md-6 col-lg-3">
											<div class="border-box scrollbar">
												<h5>Ramakrishnan Kannan</h5>
												<p>Oak Ridge National Laboratory</p>
											</div>
										</div>
										<div class="col-md-6 col-lg-3">
											<div class="border-box scrollbar">
												<h5>Sandeep Madireddy</h5>
												<p>Argonne National Laboratory (ANL)</p>
											</div>
										</div>
										<div class="col-md-6 col-lg-3">
											<div class="border-box scrollbar">
												<h5>Siddharth Singh</h5>
												<p>University of Maryland, NVIDIA Corporation</p>
											</div>
										</div>
										<div class="col-md-6 col-lg-3">
											<div class="border-box scrollbar">
												<h5>Simran Barnwal</h5>
												<p>Meta</p>
											</div>
										</div>
										<div class="col-md-6 col-lg-3">
											<div class="border-box scrollbar">
												<h5>Tirthankar Ghosal</h5>
												<p>Oak Ridge National Laboratory</p>
											</div>
										</div>
										<div class="col-md-6 col-lg-3">
											<div class="border-box scrollbar">
												<h5>William	Godoy</h5>
												<p>Oak Ridge National Laboratory (ORNL)</p>
											</div>
										</div>
										<div class="col-md-6 col-lg-3">
											<div class="border-box scrollbar">
												<h5>Yihui (Ray) Ren</h5>
												<p>Brookhaven National Laboratory</p>
											</div>
										</div>
										<div class="col-md-6 col-lg-3">
											<div class="border-box scrollbar">
												<h5>Zhe	Bai</h5>
												<p>Lawrence Berkeley National Laboratory</p>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<!-- .end AI -->

						<!-- Algorithms -->
						<div class="accordion-item">
							<div class="accordion-header" id="heading2">
								<h3 class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse2" aria-expanded="true" aria-controls="collapse2">Algorithms</h3>
							</div>
							<div id="collapse2" class="accordion-collapse collapse" aria-labelledby="heading2" data-bs-parent="#sciAccordion">
								<div class="accordion-body">
									<div class="row gy-4 alphabetically-first-name">
										<div class="col-md-6 col-lg-3">
											<div class="border-box scrollbar">
												<h5>Anshul Saxena</h5>
												<p>Symbiosis Centre for Information Technology</p>
											</div>
										</div>
										<div class="col-md-6 col-lg-3">
											<div class="border-box scrollbar">
												<h5>Aswath Babu	H</h5>
												<p>Indian Institute of Information Technology Dharwad</p>
											</div>
										</div>
										<div class="col-md-6 col-lg-3">
											<div class="border-box scrollbar">
												<h5>Ayush Maheshwari</h5>
												<p>NVIDI</p>
											</div>
										</div>
										<div class="col-md-6 col-lg-3">
											<div class="border-box scrollbar">
												<h5>Deepika	H. V.</h5>
												<p>C-DAC</p>
											</div>
										</div>
										<div class="col-md-6 col-lg-3">
											<div class="border-box scrollbar">
												<h5>Ganesh Gopalakrishnan</h5>
												<p>	University of Utah</p>
											</div>
										</div>
										<div class="col-md-6 col-lg-3">
											<div class="border-box scrollbar">
												<h5>Imran Aziz Ahmed</h5>
												<p>HPE</p>
											</div>
										</div>
										<div class="col-md-6 col-lg-3">
											<div class="border-box scrollbar">
												<h5>Kunj S Tandon</h5>
												<p>I Hub Quantum Technologies Foundation</p>
											</div>
										</div>
										<div class="col-md-6 col-lg-3">
											<div class="border-box scrollbar">
												<h5>Prashant Pandey</h5>
												<p>	Northeastern University</p>
											</div>
										</div>
										<div class="col-md-6 col-lg-3">
											<div class="border-box scrollbar">
												<h5>S Biplab Raut</h5>
												<p>AMD India Private Limited</p>
											</div>
										</div>
										<div class="col-md-6 col-lg-3">
											<div class="border-box scrollbar">
												<h5>Samir Datta</h5>
												<p>Chennai Mathematical Institute</p>
											</div>
										</div>
										<div class="col-md-6 col-lg-3">
											<div class="border-box scrollbar">
												<h5>Sengupta Shubhashis</h5>
												<p>Accenture Solutions Pvt Ltd., India</p>
											</div>
										</div>

									</div>
								</div>
							</div>
						</div>
						<!-- .end Algorithms -->

						<!-- Applications -->
						<div class="accordion-item">
							<div class="accordion-header" id="heading3">
								<h3 class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse3" aria-expanded="true" aria-controls="collapse3">Applications</h3>
							</div>
							<div id="collapse3" class="accordion-collapse collapse" aria-labelledby="heading3" data-bs-parent="#sciAccordion">
								<div class="accordion-body">
									<div class="row gy-4 alphabetically-first-name">
										<div class="col-md-6 col-lg-3">
											<div class="border-box scrollbar">
												<h5>Ana Lucia Varbanescu</h5>
												<p>University of Twente, Netherlands; University of Amsterdam, Netherlands</p>
											</div>
										</div>
										<div class="col-md-6 col-lg-3">
											<div class="border-box scrollbar">
												<h5>Bhaskar Chaudhury</h5>
												<p>Dhirubhai Ambani Institute of Information and Communication Technology</p>
											</div>
										</div>
										<div class="col-md-6 col-lg-3">
											<div class="border-box scrollbar">
												<h5>Bivas Mitra</h5>
												<p>IIT Kharagpur</p>
											</div>
										</div>
										<div class="col-md-6 col-lg-3">
											<div class="border-box scrollbar">
												<h5>Daniel Balouek</h5>
												<p>French Institute for Research in Computer Science and Automation (INRIA); University of Utah, Scientific Computing and Imaging Institute (SCI)</p>
											</div>
										</div>
										<div class="col-md-6 col-lg-3">
											<div class="border-box scrollbar">
												<h5>Dip Sankar Banerjee</h5>
												<p>Indian Institute of Technology Jodhpur</p>
											</div>
										</div>
										<div class="col-md-6 col-lg-3">
											<div class="border-box scrollbar">
												<h5>Gianluca Palermo</h5>
												<p>DEIB, Politecnico di Milano</p>
											</div>
										</div>
										<div class="col-md-6 col-lg-3">
											<div class="border-box scrollbar">
												<h5>Himanshu Goyal</h5>
												<p>Indian Institute of Technology Madras</p>
											</div>
										</div>
										<div class="col-md-6 col-lg-3">
											<div class="border-box scrollbar">
												<h5>Josef Weidendorfer</h5>
												<p>Leibniz Supercomputing Centre (LRZ), Technical University of Munich</p>
											</div>
										</div>
										<div class="col-md-6 col-lg-3">
											<div class="border-box scrollbar">
												<h5>Kamesh Madduri</h5>
												<p>Pennsylvania State University</p>
											</div>
										</div>
										<div class="col-md-6 col-lg-3">
											<div class="border-box scrollbar">
												<h5>Kishore Kothapalli</h5>
												<p>International Institute of Information Technology (IIIT), Hyderabad</p>
											</div>
										</div>
										<div class="col-md-6 col-lg-3">
											<div class="border-box scrollbar">
												<h5>Komal Kumari</h5>
												<p>Simulia Inc</p>
											</div>
										</div>
										<div class="col-md-6 col-lg-3">
											<div class="border-box scrollbar">
												<h5>Nagaiah Chamakuri</h5>
												<p>IISER Thiruvananthapuram</p>
											</div>
										</div>
										<div class="col-md-6 col-lg-3">
											<div class="border-box scrollbar">
												<h5>Nikhil Hegde</h5>
												<p>Indian Institute of Technology Dharwad</p>
											</div>
										</div>
										<div class="col-md-6 col-lg-3">
											<div class="border-box scrollbar">
												<h5>Phani Motamarri</h5>
												<p>Indian Institute of Science</p>
											</div>
										</div>
										<div class="col-md-6 col-lg-3">
											<div class="border-box scrollbar">
												<h5>Prasad Perlekar</h5>
												<p>TIFRH</p>
											</div>
										</div>
										<div class="col-md-6 col-lg-3">
											<div class="border-box scrollbar">
												<h5>Rajaram Lakkaraju</h5>
												<p>IIT Kharagpur</p>
											</div>
										</div>
										<div class="col-md-6 col-lg-3">
											<div class="border-box scrollbar">
												<h5>Sanmukh Kuppannagari</h5>
												<p>Case Western Reserve University, sxk1942@case.edu</p>
											</div>
										</div>
										<div class="col-md-6 col-lg-3">
											<div class="border-box scrollbar">
												<h5>Sathya Peri</h5>
												<p>Indian Institute of Technology Hyderabad</p>
											</div>
										</div>
										<div class="col-md-6 col-lg-3">
											<div class="border-box scrollbar">
												<h5>Somnath Roy</h5>
												<p>Indian Institute of Technology Kharagpur</p>
											</div>
										</div>
										<div class="col-md-6 col-lg-3">
											<div class="border-box scrollbar">
												<h5>Subhajit Sidhanta</h5>
												<p>IIT Kharagpur</p>
											</div>
										</div>
										<div class="col-md-6 col-lg-3">
											<div class="border-box scrollbar">
												<h5>Subodh Kumar</h5>
												<p>IIT Delhi</p>
											</div>
										</div>
										<div class="col-md-6 col-lg-3">
											<div class="border-box scrollbar">
												<h5>Sujay Deb</h5>
												<p>Indraprastha Institute of Information and Technology, Delhi</p>
											</div>
										</div>
										<div class="col-md-6 col-lg-3">
											<div class="border-box scrollbar">
												<h5>Tapan Sengupta</h5>
												<p>IIT(ISM) Dhanbad</p>
											</div>
										</div>
										<div class="col-md-6 col-lg-3">
											<div class="border-box scrollbar">
												<h5>Tapan Krishnakumar Mankodi</h5>
												<p>IIT Guwahati</p>
											</div>
										</div>
										<div class="col-md-6 col-lg-3">
											<div class="border-box scrollbar">
												<h5>Unnikrishnan Cheramangalath</h5>
												<p>Indian Institute of Technology Palakkad</p>
											</div>
										</div>

									</div>
								</div>
							</div>
						</div>
						<!-- .end Applications -->

						<!-- Architecture -->
						<div class="accordion-item">
							<div class="accordion-header" id="heading4">
								<h3 class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse4" aria-expanded="true" aria-controls="collapse4">Architecture</h3>
							</div>
							<div id="collapse4" class="accordion-collapse collapse" aria-labelledby="heading4" data-bs-parent="#sciAccordion">
								<div class="accordion-body">
									<div class="row gy-4 alphabetically-first-name">
										<div class="col-md-6 col-lg-3">
											<div class="border-box scrollbar">
												<h5>Anshu S Anand</h5>
												<p>Indian Institute of Information Technology Allahabad</p>
											</div>
										</div>
										<div class="col-md-6 col-lg-3">
											<div class="border-box scrollbar">
												<h5>Aryabartta Sahu</h5>
												<p>IIT Guwahati</p>
											</div>
										</div>
										<div class="col-md-6 col-lg-3">
											<div class="border-box scrollbar">
												<h5>Devashree Tripathy</h5>
												<p>IIT BHUBANESWAR</p>
											</div>
										</div>
										<div class="col-md-6 col-lg-3">
											<div class="border-box scrollbar">
												<h5>Dr Nitin Auluck</h5>
												<p>IIT Ropar</p>
											</div>
										</div>
										<div class="col-md-6 col-lg-3">
											<div class="border-box scrollbar">
												<h5>Janibul Bashir</h5>
												<p>National Institute of Technology Srinagar</p>
											</div>
										</div>
										<div class="col-md-6 col-lg-3">
											<div class="border-box scrollbar">
												<h5>Jyothi Vedurada</h5>
												<p>Indian Institute of Technology Hyderabad</p>
											</div>
										</div>
										<div class="col-md-6 col-lg-3">
											<div class="border-box scrollbar">
												<h5>Lena Oden</h5>
												<p>University of Hagen, Germany; Forschungszentrum Jülich</p>
											</div>
										</div>
										<div class="col-md-6 col-lg-3">
											<div class="border-box scrollbar">
												<h5>Madhura Purnaprajna</h5>
												<p>PES, AMD</p>
											</div>
										</div>
										<div class="col-md-6 col-lg-3">
											<div class="border-box scrollbar">
												<h5>Nivedita Shrivastava</h5>
												<p>Thought2design Systems Pvt. Ltd.</p>
											</div>
										</div>
										<div class="col-md-6 col-lg-3">
											<div class="border-box scrollbar">
												<h5>Ryoo Jeeho</h5>
												<p>Fairleigh Dickinson University</p>
											</div>
										</div>
										<div class="col-md-6 col-lg-3">
											<div class="border-box scrollbar">
												<h5>Sandeep Chandran</h5>
												<p>IIT Palakkad</p>
											</div>
										</div>
										<div class="col-md-6 col-lg-3">
											<div class="border-box scrollbar">
												<h5>Sarani Bhattacharya</h5>
												<p>IIT Kharagpur</p>
											</div>
										</div>
										<div class="col-md-6 col-lg-3">
											<div class="border-box scrollbar">
												<h5>Smruti Sarangi</h5>
												<p>IIT Delhi</p>
											</div>
										</div>
										<div class="col-md-6 col-lg-3">
											<div class="border-box scrollbar">
												<h5>Takatsugu Ono</h5>
												<p>Kyushu University</p>
											</div>
										</div>
										<div class="col-md-6 col-lg-3">
											<div class="border-box scrollbar">
												<h5>Vishwesh Jatala</h5>
												<p>Indian Institute of Technology Bhilai</p>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<!-- .end Architecture -->

						<!-- Cloud and Distributed HPC -->
						<div class="accordion-item">
							<div class="accordion-header" id="heading5">
								<h3 class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse5" aria-expanded="true" aria-controls="collapse5">Cloud and Distributed HPC</h3>
							</div>
							<div id="collapse5" class="accordion-collapse collapse" aria-labelledby="heading5" data-bs-parent="#sciAccordion">
								<div class="accordion-body">
									<div class="row gy-4 alphabetically-first-name">
										<div class="col-md-6 col-lg-3">
											<div class="border-box scrollbar">
												<h5>Alan Sussman</h5>
												<p>University of Maryland</p>
											</div>
										</div>
										<div class="col-md-6 col-lg-3">
											<div class="border-box scrollbar">
												<h5>Anwesha	Mukherjee</h5>
												<p>Mahishadal Raj College</p>
											</div>
										</div>
										<div class="col-md-6 col-lg-3">
											<div class="border-box scrollbar">
												<h5>Arindam Khanda</h5>
												<p>Missouri University of Science and Technology</p>
											</div>
										</div>
										<div class="col-md-6 col-lg-3">
											<div class="border-box scrollbar">
												<h5>Bheemappa Halavar</h5>
												<p>Indian Institute of Information Technology</p>
											</div>
										</div>
										<div class="col-md-6 col-lg-3">
											<div class="border-box scrollbar">
												<h5>Chandrasekaran K</h5>
											</div>
										</div>
										<div class="col-md-6 col-lg-3">
											<div class="border-box scrollbar">
												<h5>Dip Sankar Banerjee</h5>
												<p>Indian Institute of Technology Jodhpur</p>
											</div>
										</div>
										<div class="col-md-6 col-lg-3">
											<div class="border-box scrollbar">
												<h5>Dr Nitin Auluck</h5>
												<p>IIT Ropar</p>
											</div>
										</div>
										<div class="col-md-6 col-lg-3">
											<div class="border-box scrollbar">
												<h5>Furqan Baig</h5>
												<p>University of Illinois Urbana-Champaign</p>
											</div>
										</div>
										<div class="col-md-6 col-lg-3">
											<div class="border-box scrollbar">
												<h5>Gaurav Somani</h5>
												<p>Central University of Rajasthan</p>
											</div>
										</div>
										<div class="col-md-6 col-lg-3">
											<div class="border-box scrollbar">
												<h5>Geetha Kumari</h5>
												<p>BITS Pilani, Hyderabad Campus</p>
											</div>
										</div>
										<div class="col-md-6 col-lg-3">
											<div class="border-box scrollbar">
												<h5>Hari Subramoni</h5>
												<p>The Ohio State University</p>
											</div>
										</div>
										<div class="col-md-6 col-lg-3">
											<div class="border-box scrollbar">
												<h5>Inderveer Chana</h5>
												<p>Thapar University</p>
											</div>
										</div>
										<div class="col-md-6 col-lg-3">
											<div class="border-box scrollbar">
												<h5>Jie Yang</h5>
												<p>ByteDance</p>
											</div>
										</div>
										<div class="col-md-6 col-lg-3">
											<div class="border-box scrollbar">
												<h5>Kavi Khedo</h5>
												<p>University of Mauritius</p>
											</div>
										</div>
										<div class="col-md-6 col-lg-3">
											<div class="border-box scrollbar">
												<h5>Maria Rodriguez Read</h5>
												<p>The University of Melbourne</p>
											</div>
										</div>
										<div class="col-md-6 col-lg-3">
											<div class="border-box scrollbar">
												<h5>Md Arifuzzaman</h5>
												<p>Missouri University of Science and Technology</p>
											</div>
										</div>
										<div class="col-md-6 col-lg-3">
											<div class="border-box scrollbar">
												<h5>Mohammad Goudarzi</h5>
												<p>Monash University</p>
											</div>
										</div>
										<div class="col-md-6 col-lg-3">
											<div class="border-box scrollbar">
												<h5>Neelima Bayyapu</h5>
												<p>Manipal Institute of Technology Manipal Academy of Higher Education</p>
											</div>
										</div>
										<div class="col-md-6 col-lg-3">
											<div class="border-box scrollbar">
												<h5>Nicholas Chaimov</h5>
												<p>ParaTools Inc</p>
											</div>
										</div>
										<div class="col-md-6 col-lg-3">
											<div class="border-box scrollbar">
												<h5>Nicolás	Erdödy</h5>
												<p>Open Parallel Ltd, Multicore World</p>
											</div>
										</div>
										<div class="col-md-6 col-lg-3">
											<div class="border-box scrollbar">
												<h5>Satish Puri</h5>
												<p>Missouri University of Science and Technology</p>
											</div>
										</div>
										<div class="col-md-6 col-lg-3">
											<div class="border-box scrollbar">
												<h5>Vinodh Kumaran Jayakumar</h5>
												<p>University of Texas at San Antonio, JPMCHASE</p>
											</div>
										</div>
										<div class="col-md-6 col-lg-3">
											<div class="border-box scrollbar">
												<h5>Wyatt Spear</h5>
												<p>University of Oregon; ParaTools, Inc.</p>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<!-- .end Cloud and Distributed HPC -->

						<!-- Multidisciplinary -->
						<div class="accordion-item">
							<div class="accordion-header" id="heading6">
								<h3 class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse6" aria-expanded="true" aria-controls="collapse6">Multidisciplinary</h3>
							</div>
							<div id="collapse6" class="accordion-collapse collapse" aria-labelledby="heading6" data-bs-parent="#sciAccordion">
								<div class="accordion-body">
									<div class="row gy-4 alphabetically-first-name">
										<div class="col-md-6 col-lg-3">
											<div class="border-box scrollbar">
												<h5>Andreas Kloeckner</h5>
												<p>University of Illinois</p>
											</div>
										</div>
										<div class="col-md-6 col-lg-3">
											<div class="border-box scrollbar">
												<h5>Chiranjib Sur</h5>
												<p>Shell India Markets Pvt. Ltd., India; Krea University, India</p>
											</div>
										</div>
										<div class="col-md-6 col-lg-3">
											<div class="border-box scrollbar">
												<h5>David Donofrio</h5>
												<p>Tactical Computing Laboratories LLC, Lawrence Berkeley National Laboratory (LBNL)</p>
											</div>
										</div>
										<div class="col-md-6 col-lg-3">
											<div class="border-box scrollbar">
												<h5>George K. Thiruvathukal</h5>
												<p>Loyola University, Chicago; Argonne National Laboratory (ANL)</p>
											</div>
										</div>
										<div class="col-md-6 col-lg-3">
											<div class="border-box scrollbar">
												<h5>Huda Ibeid</h5>
												<p>Intel Corporation</p>
											</div>
										</div>
										<div class="col-md-6 col-lg-3">
											<div class="border-box scrollbar">
												<h5>Ian Karlin</h5>
												<p>NVIDIA Corporation</p>
											</div>
										</div>
										<div class="col-md-6 col-lg-3">
											<div class="border-box scrollbar">
												<h5>Kalyan Kumaran</h5>
												<p>Argonne National Laboratory</p>
											</div>
										</div>
										<div class="col-md-6 col-lg-3">
											<div class="border-box scrollbar">
												<h5>Michael Norman</h5>
												<p>San Diego Supercomputer Center; University of California, San Diego</p>
											</div>
										</div>
										<div class="col-md-6 col-lg-3">
											<div class="border-box scrollbar">
												<h5>Michael Robson</h5>
												<p>Smith College</p>
											</div>
										</div>
										<div class="col-md-6 col-lg-3">
											<div class="border-box scrollbar">
												<h5>Pallav Baruah</h5>
												<p>SSSIHL</p>
											</div>
										</div>
										<div class="col-md-6 col-lg-3">
											<div class="border-box scrollbar">
												<h5>Panagiotis Adamidis</h5>
												<p>DKRZ - German Climate Computing Center</p>
											</div>
										</div>
										<div class="col-md-6 col-lg-3">
											<div class="border-box scrollbar">
												<h5>Ponnuswamy Sadayappan</h5>
												<p>University of Utah, Pacific Northwest National Laboratory (PNNL)</p>
											</div>
										</div>
										<div class="col-md-6 col-lg-3">
											<div class="border-box scrollbar">
												<h5>Preeti	Malakar</h5>
												<p>Indian Institute of Technology (IIT), Kanpur</p>
											</div>
										</div>
										<div class="col-md-6 col-lg-3">
											<div class="border-box scrollbar">
												<h5>Raghavendra Kanakagiri</h5>
												<p>UIUC</p>
											</div>
										</div>
										<div class="col-md-6 col-lg-3">
											<div class="border-box scrollbar">
												<h5>Rajshekar Kalayappan</h5>
												<p>Indian Institute of Technology Dharwad</p>
											</div>
										</div>
										<div class="col-md-6 col-lg-3">
											<div class="border-box scrollbar">
												<h5>Sushil K. Prasad</h5>
												<p>University of Texas at San Antonio</p>
											</div>
										</div>
										<div class="col-md-6 col-lg-3">
											<div class="border-box scrollbar">
												<h5>VCV Rao</h5>
												<p>Centre for Development of Advanced Computing (C-DAC)</p>
											</div>
										</div>
										<div class="col-md-6 col-lg-3">
											<div class="border-box scrollbar">
												<h5>Zane Fink</h5>
												<p>Lawrence Livermore National Laboratory</p>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<!-- .end Multidisciplinary -->

						<!-- Performance -->
						<div class="accordion-item">
							<div class="accordion-header" id="heading7">
								<h3 class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse7" aria-expanded="true" aria-controls="collapse7">Performance</h3>
							</div>
							<div id="collapse7" class="accordion-collapse collapse" aria-labelledby="heading7" data-bs-parent="#sciAccordion">
								<div class="accordion-body">
									<div class="row gy-4 alphabetically-first-name">
										<div class="col-md-6 col-lg-3">
											<div class="border-box scrollbar">
												<h5>Alexandru Calotoiu</h5>
												<p>ETH Zürich</p>
											</div>
										</div>
										<div class="col-md-6 col-lg-3">
											<div class="border-box scrollbar">
												<h5>Aruna Tiwari</h5>
												<p>Indian Institute of Technology Indore</p>
											</div>
										</div>
										<div class="col-md-6 col-lg-3">
											<div class="border-box scrollbar">
												<h5>David Singh</h5>
												<p>Charles III University of Madrid</p>
											</div>
										</div>
										<div class="col-md-6 col-lg-3">
											<div class="border-box scrollbar">
												<h5>Eishi Arima</h5>
												<p>Technical University of Munich</p>
											</div>
										</div>
										<div class="col-md-6 col-lg-3">
											<div class="border-box scrollbar">
												<h5>Esteban Meneses</h5>
												<p>Costa Rica National High Technology Center, Costa Rica Institute of Technology</p>
											</div>
										</div>
										<div class="col-md-6 col-lg-3">
											<div class="border-box scrollbar">
												<h5>Hariharan Devarajan</h5>
												<p>Lawrence Livermore National Laboratory (LLNL), Illinois Institute of Technology</p>
											</div>
										</div>
										<div class="col-md-6 col-lg-3">
											<div class="border-box scrollbar">
												<h5>Hatem Ltaief</h5>
												<p>King Abdullah University of Science and Technology (KAUST)</p>
											</div>
										</div>
										<div class="col-md-6 col-lg-3">
											<div class="border-box scrollbar">
												<h5>Hervé Yviquel</h5>
												<p>UNICAMP</p>
											</div>
										</div>
										<div class="col-md-6 col-lg-3">
											<div class="border-box scrollbar">
												<h5>Jean-Baptiste Besnard</h5>
												<p>DataDirect Networks</p>
											</div>
										</div>
										<div class="col-md-6 col-lg-3">
											<div class="border-box scrollbar">
												<h5>Jyothi Vedurada</h5>
												<p>Indian Institute of Technology Hyderabad</p>
											</div>
										</div>
										<div class="col-md-6 col-lg-3">
											<div class="border-box scrollbar">
												<h5>Kshitij Mehta</h5>
												<p>Oak Ridge National Laboratory (ORNL)</p>
											</div>
										</div>
										<div class="col-md-6 col-lg-3">
											<div class="border-box scrollbar">
												<h5>Miwako Tsuji</h5>
												<p>University of Tsukuba, RIKEN Center for Computational Science (R-CCS)</p>
											</div>
										</div>
										<div class="col-md-6 col-lg-3">
											<div class="border-box scrollbar">
												<h5>Samuel Xavier-de-Souza</h5>
												<p>Universidade Federal do Rio Grande do Norte, Brazil</p>
											</div>
										</div>
										<div class="col-md-6 col-lg-3">
											<div class="border-box scrollbar">
												<h5>Shilei Tian</h5>
												<p>Advanced Micro Devices, Inc. (AMD); Stony Brook University</p>
											</div>
										</div>
										<div class="col-md-6 col-lg-3">
											<div class="border-box scrollbar">
												<h5>Wanling Gao</h5>
												<p>Institute of Computing Technology, Chinese Academy of Sciences</p>
											</div>
										</div>
										<div class="col-md-6 col-lg-3">
											<div class="border-box scrollbar">
												<h5>Yuyang Jin</h5>
												<p>Tsinghua University</p>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<!-- .end Performance -->
						
						<!-- Programming Environments -->
						<div class="accordion-item">
							<div class="accordion-header" id="heading8">
								<h3 class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse8" aria-expanded="true" aria-controls="collapse8">Programming Environments</h3>
							</div>
							<div id="collapse8" class="accordion-collapse collapse" aria-labelledby="heading8" data-bs-parent="#sciAccordion">
								<div class="accordion-body">
									<div class="row gy-4 alphabetically-first-name">
										<div class="col-md-6 col-lg-3">
											<div class="border-box scrollbar">
												<h5>Arnab K. Paul</h5>
												<p>BITS Pilani, K. K. Birla Goa Campus</p>
											</div>
										</div>
										<div class="col-md-6 col-lg-3">
											<div class="border-box scrollbar">
												<h5>Jidong Zhai</h5>
												<p>Tsinghua University</p>
											</div>
										</div>
										<div class="col-md-6 col-lg-3">
											<div class="border-box scrollbar">
												<h5>Kentaro Sano</h5>
												<p>RIKEN Center for Computational Science (R-CCS)</p>
											</div>
										</div>
										<div class="col-md-6 col-lg-3">
											<div class="border-box scrollbar">
												<h5>Martin Schulz</h5>
												<p>Technical University of Munich, Leibniz Supercomputing Centre (LRZ)</p>
											</div>
										</div>
										<div class="col-md-6 col-lg-3">
											<div class="border-box scrollbar">
												<h5>Richard Graham</h5>
												<p>NVIDIA Corporation</p>
											</div>
										</div>
										<div class="col-md-6 col-lg-3">
											<div class="border-box scrollbar">
												<h5>Ron Brightwell</h5>
												<p>Sandia National Laboratories</p>
											</div>
										</div>
										<div class="col-md-6 col-lg-3">
											<div class="border-box scrollbar">
												<h5>Sameh Abdulah</h5>
												<p>King Abdullah University of Science and Technology (KAUST)</p>
											</div>
										</div>
										<div class="col-md-6 col-lg-3">
											<div class="border-box scrollbar">
												<h5>Sheikh Ghafoor</h5>
												<p>Tennessee Technological University, National Science Foundation (NSF)</p>
											</div>
										</div>
										<div class="col-md-6 col-lg-3">
											<div class="border-box scrollbar">
												<h5>Suren Byna</h5>
												<p>The Ohio State University, Lawrence Berkeley National Laboratory (LBNL)</p>
											</div>
										</div>
										<div class="col-md-6 col-lg-3">
											<div class="border-box scrollbar">
												<h5>Yogeshwar Sonawane</h5>
												<p>Center for Development of Advanced Computing (C-DAC), India</p>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<!-- .end Programming Environments -->
						
						<!-- Quantum Computing -->
						<div class="accordion-item">
							<div class="accordion-header" id="heading9">
								<h3 class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse9" aria-expanded="true" aria-controls="collapse9">Quantum Computing</h3>
							</div>
							<div id="collapse9" class="accordion-collapse collapse" aria-labelledby="heading9" data-bs-parent="#sciAccordion">
								<div class="accordion-body">
									<div class="row gy-4 alphabetically-first-name">
										<div class="col-md-6 col-lg-3">
											<div class="border-box scrollbar">
												<h5>Ajay Singh</h5>
												<p>IIT Roorkee, Physics Departrment</p>
											</div>
										</div>
										<div class="col-md-6 col-lg-3">
											<div class="border-box scrollbar">
												<h5>Amit Saxena</h5>
												<p>Centre for Development of Advanced Computing, India; International centre of Excellencefor Computational and Biomedical Sciences</p>
											</div>
										</div>
										<div class="col-md-6 col-lg-3">
											<div class="border-box scrollbar">
												<h5>Amogh Apsingekar</h5>
												<p>Ltimindtree</p>
											</div>
										</div>
										<div class="col-md-6 col-lg-3">
											<div class="border-box scrollbar">
												<h5>Anindita Banerjee</h5>
												<p>C-DAC, Pune</p>
											</div>
										</div>
										<div class="col-md-6 col-lg-3">
											<div class="border-box scrollbar">
												<h5>Arul Lakshminarayan</h5>
												<p>IIT Madras</p>
											</div>
										</div>
										<div class="col-md-6 col-lg-3">
											<div class="border-box scrollbar">
												<h5>Deepika	H. V.</h5>
												<p>C-DAC</p>
											</div>
										</div>
										<div class="col-md-6 col-lg-3">
											<div class="border-box scrollbar">
												<h5>Dr.Jayalaxmi H</h5>
												<p>Acharya Institute of Technology</p>
											</div>
										</div>
										<div class="col-md-6 col-lg-3">
											<div class="border-box scrollbar">
												<h5>Esam El-Araby</h5>
												<p>University of Kansas</p>
											</div>
										</div>
										<div class="col-md-6 col-lg-3">
											<div class="border-box scrollbar">
												<h5>Gurmohan Singh</h5>
												<p>Centre for Development of Advanced Computing,Mohali</p>
											</div>
										</div>
										<div class="col-md-6 col-lg-3">
											<div class="border-box scrollbar">
												<h5>KANDULA ESWARA SAI KUMAR</h5>
												<p>BQP, NA</p>
											</div>
										</div>
										<div class="col-md-6 col-lg-3">
											<div class="border-box scrollbar">
												<h5>Krishna Jagannathan</h5>
												<p>IIT Madras</p>
											</div>
										</div>
										<div class="col-md-6 col-lg-3">
											<div class="border-box scrollbar">
												<h5>Manav Seksaria</h5>
												<p>IIT Madras</p>
											</div>
										</div>
										<div class="col-md-6 col-lg-3">
											<div class="border-box scrollbar">
												<h5>Manish Modani</h5>
												<p>Nvidia</p>
											</div>
										</div>
										<div class="col-md-6 col-lg-3">
											<div class="border-box scrollbar">
												<h5>Manoj Nambiar</h5>
												<p>Tata Consultancy Services, IIT Bombay</p>
											</div>
										</div>
										<div class="col-md-6 col-lg-3">
											<div class="border-box scrollbar">
												<h5>Meriam Gay Bautista-Jurney</h5>
												<p>Lawrence Berkeley National Laboratory</p>
											</div>
										</div>
										<div class="col-md-6 col-lg-3">
											<div class="border-box scrollbar">
												<h5>Nitin Chandrachoodan</h5>
												<p>IIT Madras</p>
											</div>
										</div>
										<div class="col-md-6 col-lg-3">
											<div class="border-box scrollbar">
												<h5>Prabha Mandayam</h5>
												<p>IIT Madras</p>
											</div>
										</div>
										<div class="col-md-6 col-lg-3">
											<div class="border-box scrollbar">
												<h5>Prashant Verma</h5>
												<p>SAG DRDO, Delhi Technological University</p>
											</div>
										</div>
										<div class="col-md-6 col-lg-3">
											<div class="border-box scrollbar">
												<h5>Prem Laxman Das</h5>
												<p>SETS</p>
											</div>
										</div>
										<div class="col-md-6 col-lg-3">
											<div class="border-box scrollbar">
												<h5>Raghavendra V</h5>
												<p>SRMIST</p>
											</div>
										</div>
										<div class="col-md-6 col-lg-3">
											<div class="border-box scrollbar">
												<h5>Rajesh Narayanan</h5>
												<p>Indian Institute of Technology-Madras</p>
											</div>
										</div>
										<div class="col-md-6 col-lg-3">
											<div class="border-box scrollbar">
												<h5>Samrit Kumar Maity</h5>
												<p>Centre for Development of Advanced Computing, India</p>
											</div>
										</div>
										<div class="col-md-6 col-lg-3">
											<div class="border-box scrollbar">
												<h5>Srikumar Subramanian</h5>
												<p>Accenture Labs</p>
											</div>
										</div>
										<div class="col-md-6 col-lg-3">
											<div class="border-box scrollbar">
												<h5>Sunethra Ramanan</h5>
												<p>Indian Institute of Technology Madras</p>
											</div>
										</div>
										<div class="col-md-6 col-lg-3">
											<div class="border-box scrollbar">
												<h5>Sven Karlsson</h5>
												<p>Technical University of Denmark</p>
											</div>
										</div>
										<div class="col-md-6 col-lg-3">
											<div class="border-box scrollbar">
												<h5>Swathi Kovvuri</h5>
												<p>Intel Corporation</p>
											</div>
										</div>
										<div class="col-md-6 col-lg-3">
											<div class="border-box scrollbar">
												<h5>Udayaadithya Avadhanam</h5>
												<p>Mphasis</p>
											</div>
										</div>
										<div class="col-md-6 col-lg-3">
											<div class="border-box scrollbar">
												<h5>Vaibhav Madhok</h5>
												<p>Indian Institute of Technology Madras</p>
											</div>
										</div>
										<div class="col-md-6 col-lg-3">
											<div class="border-box scrollbar">
												<h5>Vaibhav Pratap Singh</h5>
												<p>CDAC Bangalore</p>
											</div>
										</div>
										<div class="col-md-6 col-lg-3">
											<div class="border-box scrollbar">
												<h5>Vipin Chaudhary</h5>
												<p>Case Western Reserve University</p>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<!-- .end Quantum Computing -->
					</div>
					<!-- .end accordion sci-accordion flat-lable-accordion -->
				</div>
			</div>
		</div>
	</section>

	<!-- profileModal Modal-->
	<div class="modal fade profile-modal" id="profileModal" tabindex="-1" aria-hidden="true">
		<div class="modal-dialog modal-lg modal-dialog-centered ">
			<div class="modal-content bg-black text-white position-relative rounded-4">
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				<div class="modal-header border-0">
					<div class="pro-img">
						<img id="modalPhoto" src="" alt="Profile Photo" class="rounded-circle m-profile-photo" />
					</div>
					<div class="modal-title">
						<h5 id="modalTitle" class="modal-title text-white fw-bold"></h5>
						<p id="modalRole" class="text-warning fw-semibold mb-1"></p>
						<p id="modalAffiliation" class="text-white-50 mb-1"></p>
					</div>
				</div>
				<div class="modal-body bio-content scrollbar">
					<p id="modalBio" class="text-white"></p>
				</div>
			</div>
		</div>
	</div>
<?php include 'scinew-include/footer.php'; ?>
	<?php include 'include/footer.php'; ?>

	<!-- jQuery library CDN Path -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js" crossorigin="anonymous"></script>

	<!-- Vendor JS CDN path -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js" ></script>

	<script>
		// call AOS function - Animate on scroll library function to animate HTML Elements
		AOS.init();

		// Display the PC Members names sorted alphabetically (A → Z) as soon as the page loads.
		$(document).ready(function() {
			// Loop through each accordion body that needs sorting
			$(".hp-pc-members-sec .accordion-body .alphabetically-first-name").each(function() {
				var container = $(this);

				// Get all child columns (cards)
				var items = container.children(".col-md-6.col-lg-3").get();

				// Sort them alphabetically by the text inside <h5>
				items.sort(function(a, b) {
				var nameA = $(a).find("h5").text().trim().toUpperCase();
				var nameB = $(b).find("h5").text().trim().toUpperCase();
				return nameA.localeCompare(nameB);
				});

				// Re-append sorted items to the container
				$.each(items, function(index, item) {
				container.append(item);
				});
			});
		});
		
		// Call profile modal with bio
		document.addEventListener("DOMContentLoaded", function () {
			const speakerCards = document.querySelectorAll(".speaker-card");
			const modalElement = document.getElementById("profileModal");

			speakerCards.forEach((card) => {
				card.addEventListener("click", () => {
					const img = card.querySelector(".speaker-img img");
					const name = img.getAttribute("data-name") || card.querySelector("h5")?.textContent || "";
					const role = img.getAttribute("data-role") || card.querySelector(".keynote")?.textContent || "";
					const affiliation = img.getAttribute("data-affiliation") || "";
					const bio = img.getAttribute("data-bio") || "";
					const src = img.getAttribute("src");

					if (!modalElement) return; // ✅ Prevent error if modal doesn't exist

					document.getElementById("modalPhoto").src = src;
					document.getElementById("modalTitle").textContent = name;

					const formattedRole = role.split("||").join("<br>");
					document.getElementById("modalRole").innerHTML = formattedRole;

					const formattedAffiliation = affiliation.split("||").join("<br>");
					document.getElementById("modalAffiliation").innerHTML = formattedAffiliation;

					document.getElementById("modalBio").textContent = bio;

					const modal = new bootstrap.Modal(modalElement);
					modal.show();
				});
			});

			// ✅ Add event listener only if modal exists
			if (modalElement) {
				modalElement.addEventListener("hidden.bs.modal", () => {
					const backdrops = document.querySelectorAll(".modal-backdrop");
					backdrops.forEach((backdrop) => backdrop.remove());
					document.body.classList.remove("modal-open");
					document.body.style.paddingRight = "";
				});
			}
		});

		// Track PC Members accordion item to automatically scroll into view (from the top) when expanded with offset.
		$(document).on('shown.bs.collapse', '.track-pc-members-accordion .accordion-collapse', function () {
			const headerOffset = 100; // 👈 change this value if your header is taller/shorter
			const itemTop = $(this).closest('.accordion-item').offset().top - headerOffset;
		
			$('html, body').animate({
				scrollTop: itemTop
			}, 400); // 400ms = smooth scroll duration
		});
	</script>
</body>
</html>

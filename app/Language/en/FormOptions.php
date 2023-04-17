<?php
return [
    'common' => [
        'sim_nao' => 'S=Yes;N=No',
        'default_lang' => 'en=English;es=Spanish;tr=Turkish;de=Deutsch;hu=Hungarian',
        'gender' => 'M=Male;F=Female;O=Other'
    ],
    'terms' => [
        'status' => 'draft=Draft;active=Active;history=History',
        'target_role' => 'admin=Administrator;platform_assistant=Platform Assistant;clinic_admin=Clinic Admin;clinic_user=Clinic User',
    ],
    'documents' => [
        'role_access' => 'admin=Administrator;platform_assistant=Platform Assistant;clinic_admin=Clinic Admin;clinic_medic=Medic;clinic_audiologist=Audiologist',
        'type' => 'img=Image;mov=Video;doc=Word,xls=Excel,ppt=Power Point;pdf=PDF;other=Other',
    ],
    'users' => [
        'access_type' => 'any=All;api=API;portal=Portal;app=App',
        'roles' => 'admin=Administrator;platform_assitant=Platform Assistant;clinic_user=Clinic User',
    ],
    'patients' => [
        'side_hear_loss' => 'L=Left;R=Right;B=Bilateral',
        'consent' => 'S=Yes;N=No;P=Not Informed;=Not Informed',
    ],
    'clinics' => [
        'role_to_label' => 'clinic_medic=Medic;clinic_assistant=Assistant;clinic_audiologist=Audiologist',
        //-- Necessário pora traducao de role em SwitchClinic
        'roles' => 'clinic_medic=Medic;clinic_assistant=Assistant;clinic_audiologist=Audiologist;clinic_admin=Clinic Admin',
    ],
    'clinics_users' => [
        'invite_status' => 'P=Pending;A=Accepted;D=Declined;E=Expired',
    ],
    'icd' => [
        'category' => 'DC=Diagnostic Code;IC=Intervention Code'
    ],
    'patients_icd' => [
        'ear_side' => 'L=Left;R=Right;B=Bilateral'
    ],
    'exams' => [
        'exam_type' => 'pre_intervention=Baseline;intervention=Surgery;post_intervention=Followup',
        'patient_ear' => 'L=Left;R=Right',
        'audiogram' => '=;NT;M;-10;-5;0;5;10;15;20;25;30;35;40;45;50;55;60;65;70;75;80;85;90;95;100;105;110;115;120',
        'employement_status' => 'employed_ft=Employed Full-time;employed_pt=Employed Part-time;unemployed=Unemployed;employed_sf=Self-employed;retired_age=Retired (because of age);retired_ill=Retired (because of illness);student=Student;homemaker=Home Maker',
        'received_implant' => '=;porp=PORP;torp=TORP;stapes=Stapes prosthesis;pbc_implant=Passive Bone Conduction Implant;abc_implant=Active Bone Conducion Implant;me_implant=Middle Ear Implant;cochlear_implant=Cochlear Implant',
        'et_function' => '=;cleft_ps=Cleft palate, syndromic;hme_effusion=History of middle ear effusion;naso_issues=Nasopharyngeal issues;chronic_rhino=Chronic rhinosinusitis',
        'mastoid_status' => '=;clear=Clear;chronic_infection=Chronic infection;cholesteatoma=Cholesteatoma',
        'attic' => '=;open=Open;blocked=Blocked',
    ]
];

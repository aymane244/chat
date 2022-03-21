<!doctype html>
<html lang="ENG">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="veiwport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.min.js" integrity="sha384-VHvPCCyXqtD5DqJeNxl2dtTyhF78xXNXdkwX1CZeRusQfRKp+tA7hAShOK/B/fQ2" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/abe6e1e5f4.js" crossorigin="anonymous"></script>
    <style>
        .div-bg{
            background-image: url('images/background.jpg');
            background-size: 100% 100%;
            background-repeat: no-repeat;
        }
        .div-bg2{
            background-color: rgba(77, 82, 89, 0.4);
            background-size: 100%;
            background-repeat: no-repeat;
        }
        .div-background{
            background-color: rgba(72, 176, 247, 0.4);
            background-size: 100%;
            background-repeat: no-repeat;
            border-radius: 5px;
        }
        input{
            border-radius: 0 !important;
        }
        button{
            border-radius: 0 !important;
        }
        .icon {
            position: absolute;
            font-size: x-large;
            padding-top: 6px;
            padding-left: 11px;
            color: #48b0f7;
        }
        select{
            border-radius: 0 !important;
        }
        .div-popup{
            background-color: #48b0f7;
            position: absolute;
            margin-left: auto;
            margin-right: auto;
            left:0;
            right:0;
            top:30%;
            font-size: x-large;
            font-weight: bold;
            border: double;
            z-index : 2;
        }
        .divbg{
            background-color: #48b0f7;
        }
        .fade-out{
            animation-duration: 1s;
            animation-name: text-hide;
            opacity: 0;
        }
        @keyframes text-hide {
            from{
                opacity: 1;
            }
            to{
                opacity: 0;
            }
        }
        .logout{
            position: absolute;
            top : 0;
            right: 10px;

        }
        .link{
            text-decoration: none;
            color: black;
        }
        .link:hover{
            color: black;
            text-decoration: none;
        }
        .fa-xmark{
            cursor: pointer;
            color: red;
        }
        .card-bordered {
            border: 1px solid #ebebeb
        }
        .card {
            border: 0;
            border-radius: 0px;
            margin-bottom: 30px;
            -webkit-box-shadow: 0 2px 3px rgba(0, 0, 0, 0.03);
            box-shadow: 0 2px 3px rgba(0, 0, 0, 0.03);
            -webkit-transition: .5s;
            transition: .5s
        }
        .text-home{
            border-radius:5px 0 0 5px;
            border-right: 1px solid #24587B;
            cursor: pointer;
            background-color:#48b0f7;
        }
        .text-home-2{
            border-radius:0 5px 5px 0;
            background-color:#48b0f7;
        }
        .text-home:hover{
            background-color: #0069D9;
        }
        .text-home-2:hover{
            background-color: #0069D9;
        }
        textarea{
            height:100px;
            outline: none;   
        }
        .border{
            outline: none;
        }
        .para-style{
            border: 1px solid black;
        }
        .img-profile{
            width :10%;
            border-radius: 50%;
        }
        .div-chat{
            background-color: #FFFFFF;
        }
        .link-btn{
            border-radius: 0;
        }
        .contacts{
            cursor: pointer;
        }
        .contacts:hover{
            text-decoration: none;
        }
        .fa-arrow-left{
            font-size: 35px;
            position: absolute;
            padding-top:5px;
            cursor: pointer;
        }

        .bg-p{
            background-color: #48b0f7;
            padding: 5px;
            border-radius: 5px;
        }
        .span-style{
            font-size: small;
            color: grey;
        }
        .div-border{
            border-left: 1px solid black;
        }
        #offline{
            background: #9B9C9E;
            border-radius: 50%;
            padding: 4px;
            font-size:1px;
            position: absolute;
            margin-top: 1px;
            margin-left:-5px;
        }
        #online{
            background: greenyellow;
            border-radius: 50%;
            padding: 4px;
            font-size:1px;
            position: absolute;
            margin-top: 1px;
            margin-left:-5px;
        }
        .img-contact{
            border-radius: 50%;
            width: 10%;
        }
        .img-chat{
            border-radius: 50%;
            width: 5%;
        }
        .publisher {
            position: relative;
            display: -webkit-box;
            display: flex;
            -webkit-box-align: center;
            align-items: center;
            padding: 12px 20px;
            background-color: #f9fafb
        }
        .publisher>*:first-child {
            margin-left: 0
        }

        .publisher>* {
            margin: 0 8px
        }
        .publisher-input {
            -webkit-box-flex: 1;
            flex-grow: 1;
            border: none;
            outline: none !important;
            background-color: transparent
        }
        .publisher-btn {
            background-color: transparent;
            border: none;
            color: #cac7c7;
            font-size: 16px;
            cursor: pointer;
            overflow: -moz-hidden-unscrollable;
            -webkit-transition: .2s linear;
            transition: .2s linear
        }
        .bt-1 {
            border-top: 1px solid #ebebeb !important
        }
        .border-light {
            border-color: #f1f2f3 !important
        }
        .file-group {
            position: relative;
            overflow: hidden;
            color : #48b0f7;
        }
        .file-group input[type="file"] {
            position: absolute;
            opacity: 0;
            z-index: -1;
            width: 20px
        }
        #fixed{
            position: fixed;
            bottom:0;
            width: 730px;
            z-index: 0;
            background-color: #FFFFFF;
            border:none;
        }
        .fa-x{
            position: absolute;
            padding-top: 6px;
            right: 20px;
            cursor: pointer;
        }
        .delet-link{
            color:#183153;
        }
        .delet-link:hover{
            color:#183153;
        }
        .div-margin{
            margin-top: 60px;
        }
    </style>
</head>
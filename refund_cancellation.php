

<?php include("headertest.php"); ?>
  
<section class="refund-policy">
    <div class="policy-card">
        <h2>Refund & Cancellation Policy</h2>

        <div class="policy-line"></div>

        <p>
            The fee once paid shall not be refunded.
        </p>

        <p>
            MaRRS reserves the right to cancel the events/trainings if unforeseen
            circumstances such as hartal, natural calamities, or other unavoidable
            situations occur.
        </p>
    </div>
</section>

<style>
.refund-policy{
    min-height:100vh;
    display:flex;
    align-items:center;
    justify-content:center;
    padding:30px 20px;
    font-family:Arial, sans-serif;
}

.policy-card{
    background:#fff;
    max-width:750px;
    width:100%;
    padding:50px 40px;
    border-radius:20px;
    text-align:center;
    box-shadow:0 10px 30px rgba(0,0,0,0.1);
    position:relative;
    overflow:hidden;
}

.policy-card::before{
    content:"";
    position:absolute;
    top:0;
    left:0;
    width:100%;
    height:6px;
    background:linear-gradient(90deg,#007bff,#00c6ff);
}

.policy-card h2{
    font-size:36px;
    color:#222;
    margin-bottom:15px;
    font-weight:700;
}

.policy-line{
    width:80px;
    height:4px;
    background:#007bff;
    margin:0 auto 30px;
    border-radius:10px;
}

.policy-card p{
    font-size:18px;
    line-height:1.8;
    color:#555;
    margin-bottom:20px;
}

@media(max-width:768px){
    .policy-card{
        padding:35px 25px;
    }

    .policy-card h2{
        font-size:28px;
    }

    .policy-card p{
        font-size:16px;
    }
}
</style>

<?php include("footertest.php"); ?>
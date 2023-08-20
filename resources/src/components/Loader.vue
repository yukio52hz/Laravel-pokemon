<template>
   <span class="loaderBalls"></span>
</template>
<script>
  export default {
    name: "Loader",

  }
  </script>
<style lang="css" scoped>
.loaderBalls {
  position: relative;
  display: flex;
}
        .loaderBalls:before , .loaderBalls:after {
            content: '';
            width: 15px;
            height: 15px;
            display: inline-block;
            position: relative;
            margin: 0  5px  ;
            border-radius: 50%;
            color: purple;
            background: currentColor;
            box-shadow: 50px 0 ,  -50px 0;
            animation: left 1s infinite ease-in-out;
          }
          .loaderBalls:after {
            color: #FF3D00;
            animation: right 1.1s infinite ease-in-out;
          }


        @keyframes right {
          0% , 100%{transform: translateY(-10px) }
          50% { transform: translateY(10px) }
        }

        @keyframes left {
          0% , 100%{ transform: translateY(10px) }
          50% { transform: translateY(-10px) }
        }
</style>

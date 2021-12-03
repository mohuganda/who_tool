<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>iHRIS UPDATE TOOL | Login</title>

     <link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/font-awesome/css/font-awesome.css" rel="stylesheet">



<style>

/*--------------------
General Style
---------------------*/
*,
*::before,
*::after {
  box-sizing: border-box;
}

body,
html {

}

body {
    background: #6da8d1;
    background-repeat: no-repeat;
    background-size: cover;
    background-position: 100%;
    height: 100vh;
    overflow-x: hidden;
    text-rendering: optimizeLegibility;
}

/*--------------------
Text
---------------------*/

h2, h3 {
  font-size: 16px;
	letter-spacing: -1px;
  line-height: 20px;
}

h2 {
	color: #feffff;
	text-align: center;
}

h3 {
	color: #032942;
	text-align: right;
}

/*--------------------
Icons
---------------------*/
.i {
  width: 20px;
  height: 20px;
}

.i-login {
  margin: 13px 0px 0px 15px;
  position: relative;
  float: left;
  background-image: url(data:image/svg+xml;utf8;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pgo8IS0tIEdlbmVyYXRvcjogQWRvYmUgSWxsdXN0cmF0b3IgMTYuMC4wLCBTVkcgRXhwb3J0IFBsdWctSW4gLiBTVkcgVmVyc2lvbjogNi4wMCBCdWlsZCAwKSAgLS0+CjwhRE9DVFlQRSBzdmcgUFVCTElDICItLy9XM0MvL0RURCBTVkcgMS4xLy9FTiIgImh0dHA6Ly93d3cudzMub3JnL0dyYXBoaWNzL1NWRy8xLjEvRFREL3N2ZzExLmR0ZCI+CjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayIgdmVyc2lvbj0iMS4xIiBpZD0iQ2FwYV8xIiB4PSIwcHgiIHk9IjBweCIgd2lkdGg9IjY0cHgiIGhlaWdodD0iNjRweCIgdmlld0JveD0iMCAwIDQxNi4yMjkgNDE2LjIyOSIgc3R5bGU9ImVuYWJsZS1iYWNrZ3JvdW5kOm5ldyAwIDAgNDE2LjIyOSA0MTYuMjI5OyIgeG1sOnNwYWNlPSJwcmVzZXJ2ZSI+CjxnPgoJPGc+CgkJPHBhdGggZD0iTTQwMy43MjksMjkuNjVINzEuODAyYy02LjkwMywwLTEyLjUsNS41OTctMTIuNSwxMi41djg2LjM2M2MwLDYuOTAzLDUuNTk3LDEyLjUsMTIuNSwxMi41czEyLjUtNS41OTcsMTIuNS0xMi41VjU0LjY1ICAgIGgzMDYuOTI3djMwNi45MjhIODQuMzAydi03My44NjFjMC02LjkwMy01LjU5Ny0xMi41LTEyLjUtMTIuNXMtMTIuNSw1LjU5Ny0xMi41LDEyLjV2ODYuMzYxYzAsNi45MDMsNS41OTcsMTIuNSwxMi41LDEyLjUgICAgaDMzMS45MjdjNi45MDIsMCwxMi41LTUuNTk3LDEyLjUtMTIuNVY0Mi4xNUM0MTYuMjI5LDM1LjI0Nyw0MTAuNjMxLDI5LjY1LDQwMy43MjksMjkuNjV6IiBmaWxsPSIjODczMTRlIi8+CgkJPHBhdGggZD0iTTE4NS40MTcsMjg3LjgxMWMwLDUuMDU3LDMuMDQ1LDkuNjEzLDcuNzE2LDExLjU1YzEuNTQ3LDAuNjQyLDMuMTcsMC45NSw0Ljc4MSwwLjk1YzMuMjUzLDAsNi40NTEtMS4yNyw4Ljg0Mi0zLjY2ICAgIGw3OS42OTctNzkuNjk3YzIuMzQ0LTIuMzQ0LDMuNjYtNS41MjMsMy42Ni04LjgzOWMwLTMuMzE2LTEuMzE2LTYuNDk1LTMuNjYtOC44MzlsLTc5LjY5Ny03OS42OTcgICAgYy0zLjU3NS0zLjU3NS04Ljk1MS00LjY0Ni0xMy42MjMtMi43MWMtNC42NzEsMS45MzYtNy43MTYsNi40OTMtNy43MTYsMTEuNTQ5djY3LjE5N0gxMi41Yy02LjkwMywwLTEyLjUsNS41OTctMTIuNSwxMi41ICAgIGMwLDYuOTAzLDUuNTk3LDEyLjUsMTIuNSwxMi41aDE3Mi45MTdWMjg3LjgxMUwxODUuNDE3LDI4Ny44MTF6IE0yMTAuNDE3LDE1OC41OTRsNDkuNTIxLDQ5LjUybC00OS41MjEsNDkuNTIxVjE1OC41OTR6IiBmaWxsPSIjODczMTRlIi8+Cgk8L2c+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPC9zdmc+Cg==);
  background-size: 18px 18px;
  background-repeat: no-repeat;
  background-position: center;
}

.i-more {
  background-image: url(data:image/svg+xml;utf8;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pgo8IS0tIEdlbmVyYXRvcjogQWRvYmUgSWxsdXN0cmF0b3IgMTYuMC4wLCBTVkcgRXhwb3J0IFBsdWctSW4gLiBTVkcgVmVyc2lvbjogNi4wMCBCdWlsZCAwKSAgLS0+CjwhRE9DVFlQRSBzdmcgUFVCTElDICItLy9XM0MvL0RURCBTVkcgMS4xLy9FTiIgImh0dHA6Ly93d3cudzMub3JnL0dyYXBoaWNzL1NWRy8xLjEvRFREL3N2ZzExLmR0ZCI+CjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayIgdmVyc2lvbj0iMS4xIiBpZD0iQ2FwYV8xIiB4PSIwcHgiIHk9IjBweCIgd2lkdGg9IjY0cHgiIGhlaWdodD0iNjRweCIgdmlld0JveD0iMCAwIDYxMiA2MTIiIHN0eWxlPSJlbmFibGUtYmFja2dyb3VuZDpuZXcgMCAwIDYxMiA2MTI7IiB4bWw6c3BhY2U9InByZXNlcnZlIj4KPGc+Cgk8ZyBpZD0ibW9yZSI+CgkJPGc+CgkJCTxwYXRoIGQ9Ik03Ni41LDIyOS41QzM0LjMsMjI5LjUsMCwyNjMuOCwwLDMwNnMzNC4zLDc2LjUsNzYuNSw3Ni41UzE1MywzNDguMiwxNTMsMzA2UzExOC43LDIyOS41LDc2LjUsMjI5LjV6IE03Ni41LDM0NC4yICAgICBjLTIxLjEsMC0zOC4yLTE3LjEwMS0zOC4yLTM4LjJjMC0yMS4xLDE3LjEtMzguMiwzOC4yLTM4LjJzMzguMiwxNy4xLDM4LjIsMzguMkMxMTQuNywzMjcuMSw5Ny42LDM0NC4yLDc2LjUsMzQ0LjJ6ICAgICAgTTUzNS41LDIyOS41Yy00Mi4yLDAtNzYuNSwzNC4zLTc2LjUsNzYuNXMzNC4zLDc2LjUsNzYuNSw3Ni41UzYxMiwzNDguMiw2MTIsMzA2UzU3Ny43LDIyOS41LDUzNS41LDIyOS41eiBNNTM1LjUsMzQ0LjIgICAgIGMtMjEuMSwwLTM4LjItMTcuMTAxLTM4LjItMzguMmMwLTIxLjEsMTcuMTAxLTM4LjIsMzguMi0zOC4yczM4LjIsMTcuMSwzOC4yLDM4LjJDNTczLjcsMzI3LjEsNTU2LjYsMzQ0LjIsNTM1LjUsMzQ0LjJ6ICAgICAgTTMwNiwyMjkuNWMtNDIuMiwwLTc2LjUsMzQuMy03Ni41LDc2LjVzMzQuMyw3Ni41LDc2LjUsNzYuNXM3Ni41LTM0LjMsNzYuNS03Ni41UzM0OC4yLDIyOS41LDMwNiwyMjkuNXogTTMwNiwzNDQuMiAgICAgYy0yMS4xLDAtMzguMi0xNy4xMDEtMzguMi0zOC4yYzAtMjEuMSwxNy4xLTM4LjIsMzguMi0zOC4yYzIxLjEsMCwzOC4yLDE3LjEsMzguMiwzOC4yQzM0NC4yLDMyNy4xLDMyNy4xLDM0NC4yLDMwNiwzNDQuMnoiIGZpbGw9IiNkZjQwNWEiLz4KCQk8L2c+Cgk8L2c+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPC9zdmc+Cg==);
  background-size: 20px 20px;
  background-repeat: no-repeat;
  background-position: center;
}

.i-save {
  background-image: url(data:image/svg+xml;utf8;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pgo8IS0tIEdlbmVyYXRvcjogQWRvYmUgSWxsdXN0cmF0b3IgMTYuMC4wLCBTVkcgRXhwb3J0IFBsdWctSW4gLiBTVkcgVmVyc2lvbjogNi4wMCBCdWlsZCAwKSAgLS0+CjwhRE9DVFlQRSBzdmcgUFVCTElDICItLy9XM0MvL0RURCBTVkcgMS4xLy9FTiIgImh0dHA6Ly93d3cudzMub3JnL0dyYXBoaWNzL1NWRy8xLjEvRFREL3N2ZzExLmR0ZCI+CjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayIgdmVyc2lvbj0iMS4xIiBpZD0iQ2FwYV8xIiB4PSIwcHgiIHk9IjBweCIgd2lkdGg9IjY0cHgiIGhlaWdodD0iNjRweCIgdmlld0JveD0iMCAwIDYxMiA2MTIiIHN0eWxlPSJlbmFibGUtYmFja2dyb3VuZDpuZXcgMCAwIDYxMiA2MTI7IiB4bWw6c3BhY2U9InByZXNlcnZlIj4KPGc+Cgk8ZyBpZD0idGljayI+CgkJPGc+CgkJCTxwYXRoIGQ9Ik00MzYuNywxOTYuNzAxTDI1OC4xODgsMzc1LjIxM2wtODIuODY5LTgyLjg4N2MtNy4yODctNy4yODctMTkuMTI1LTcuMjg3LTI2LjQxMiwwcy03LjI4NywxOS4xMjUsMCwyNi40MTIgICAgIGw5My44MDgsOTMuODA4YzAuNjMxLDAuODk5LDEuMDE0LDEuOTMyLDEuODE3LDIuNzM1YzMuNzY4LDMuNzY4LDguNzIxLDUuNTA4LDEzLjY1NSw1LjM3NGM0LjkzNCwwLjExNSw5LjkwNy0xLjYwNiwxMy42NzQtNS4zNzQgICAgIGMwLjgwMy0wLjgwNCwxLjE4Ni0xLjgzNiwxLjgxNy0yLjczNWwxODkuNDM0LTE4OS40MzNjNy4yODYtNy4yODcsNy4yODYtMTkuMTI1LDAtMjYuNDEyICAgICBDNDU1LjgwNiwxODkuNDE0LDQ0My45ODcsMTg5LjQxNCw0MzYuNywxOTYuNzAxeiBNMzA2LDBDMTM2Ljk5MiwwLDAsMTM2Ljk5MiwwLDMwNnMxMzYuOTkyLDMwNiwzMDYsMzA2ICAgICBjMTY4Ljk4OCwwLDMwNi0xMzYuOTkyLDMwNi0zMDZTNDc1LjAwOCwwLDMwNiwweiBNMzA2LDU3My43NUMxNTguMTI1LDU3My43NSwzOC4yNSw0NTMuODc1LDM4LjI1LDMwNiAgICAgQzM4LjI1LDE1OC4xMjUsMTU4LjEyNSwzOC4yNSwzMDYsMzguMjVjMTQ3Ljg3NSwwLDI2Ny43NSwxMTkuODc1LDI2Ny43NSwyNjcuNzVDNTczLjc1LDQ1My44NzUsNDUzLjg3NSw1NzMuNzUsMzA2LDU3My43NXoiIGZpbGw9IiMyMGMxOTgiLz4KCQk8L2c+Cgk8L2c+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPC9zdmc+Cg==);
  background-size: 20px 20px;
  background-repeat: no-repeat;
  background-position: center;
}

.i-warning {
  background-image: url(data:image/svg+xml;utf8;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pgo8IS0tIEdlbmVyYXRvcjogQWRvYmUgSWxsdXN0cmF0b3IgMTguMS4xLCBTVkcgRXhwb3J0IFBsdWctSW4gLiBTVkcgVmVyc2lvbjogNi4wMCBCdWlsZCAwKSAgLS0+CjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayIgdmVyc2lvbj0iMS4xIiBpZD0iQ2FwYV8xIiB4PSIwcHgiIHk9IjBweCIgdmlld0JveD0iMCAwIDYxMi44MTYgNjEyLjgxNiIgc3R5bGU9ImVuYWJsZS1iYWNrZ3JvdW5kOm5ldyAwIDAgNjEyLjgxNiA2MTIuODE2OyIgeG1sOnNwYWNlPSJwcmVzZXJ2ZSIgd2lkdGg9IjY0cHgiIGhlaWdodD0iNjRweCI+CjxnPgoJPHBhdGggZD0iTTMwNi40MDgsMEMxMzcuMzY4LDAsMC4zNzEsMTM2Ljk5NywwLjM3MSwzMDYuMDM3czEzNi45OTcsMzA2Ljc3OSwzMDYuMDM3LDMwNi43NzlzMzA2LjAzNy0xMzcuODEzLDMwNi4wMzctMzA2LjAzNyAgIEM2MTIuNDQ1LDEzNy43MzksNDc1LjQ0OCwwLDMwNi40MDgsMHogTTMwNi40MDgsNTgzLjE0N2MtMTUyLjIwMywwLTI3Ni4zNjgtMTI0LjE2NS0yNzYuMzY4LTI3Ni4zNjggICBTMTU0LjIwNSwyOS41OTUsMzA2LjQwOCwyOS41OTVTNTgyLjc3NiwxNTMuNzYsNTgyLjc3NiwzMDYuNzc5UzQ1OC42MTEsNTgzLjE0NywzMDYuNDA4LDU4My4xNDd6IE0zMjEuNjEzLDQzMS43NiAgIGMwLDguODI3LTcuMTk1LDE2LjAyMS0xNi4wMjEsMTYuMDIxYy04LjgyNywwLTE2LjAyMS03LjE5NS0xNi4wMjEtMTYuMDIxYzAtOC44MjcsNy4xOTUtMTYuMDIxLDE2LjAyMS0xNi4wMjEgICBTMzIxLjYxMyw0MjIuOTM0LDMyMS42MTMsNDMxLjc2eiBNMjkwLjM4NywzNTMuMjExdi0xODAuMjRjMC04LjAxMSw2LjM3OS0xNC4zOSwxNC4zOS0xNC4zOWM4LjAxMSwwLDE0LjM5LDYuMzc5LDE0LjM5LDE0LjM5ICAgdjE4MC4yNGMwLDguMDExLTYuMzc5LDE0LjM5LTE0LjM5LDE0LjM5QzI5Ni43NjYsMzY4LjQ5MSwyOTAuMzg3LDM2MS4yMjIsMjkwLjM4NywzNTMuMjExeiIgZmlsbD0iI2Y1ZDg3OCIvPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+Cjwvc3ZnPgo=);
  background-size: 20px 20px;
  background-repeat: no-repeat;
  background-position: center;
}

.i-close {
  background-image: url(data:image/svg+xml;utf8;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pgo8IS0tIEdlbmVyYXRvcjogQWRvYmUgSWxsdXN0cmF0b3IgMTguMS4xLCBTVkcgRXhwb3J0IFBsdWctSW4gLiBTVkcgVmVyc2lvbjogNi4wMCBCdWlsZCAwKSAgLS0+CjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayIgdmVyc2lvbj0iMS4xIiBpZD0iQ2FwYV8xIiB4PSIwcHgiIHk9IjBweCIgdmlld0JveD0iMCAwIDYxMi40NDUgNjEyLjQ0NSIgc3R5bGU9ImVuYWJsZS1iYWNrZ3JvdW5kOm5ldyAwIDAgNjEyLjQ0NSA2MTIuNDQ1OyIgeG1sOnNwYWNlPSJwcmVzZXJ2ZSIgd2lkdGg9IjY0cHgiIGhlaWdodD0iNjRweCI+CjxnPgoJPHBhdGggZD0iTTUyMi42NDIsODkuODA0QzQ2NC45LDMyLjA2MiwzODguMDExLDAsMzA2LjIyMywwUzE0Ny41NDUsMzIuMDYyLDg5LjgwNCw4OS44MDQgICBjLTExOS40MTYsMTE5LjQxNi0xMTkuNDE2LDMxMy40MjIsMCw0MzIuODM4YzU3Ljc0MSw1Ny43NDEsMTM0LjYzMSw4OS44MDQsMjE2LjQxOSw4OS44MDRzMTU4LjY3OC0zMi4wNjIsMjE2LjQxOS04OS44MDQgICBDNjQyLjA1OCw0MDMuMjI1LDY0Mi4wNTgsMjA5LjIyLDUyMi42NDIsODkuODA0eiBNNTAxLjc4Nyw1MDEuNzg3Yy01Mi4xMDEsNTIuMTAxLTEyMS43OTEsODAuOTcyLTE5NS41NjQsODAuOTcyICAgcy0xNDMuNDYzLTI4Ljg3MS0xOTUuNTY0LTgwLjk3MlMyOS42ODcsMzc5Ljk5NSwyOS42ODcsMzA2LjIyM3MyOC44NzEtMTQzLjQ2Myw4MC45NzItMTk1LjU2NHMxMjEuODY2LTgwLjk3MiwxOTUuNTY0LTgwLjk3MiAgIHMxNDMuNDYzLDI4Ljg3MSwxOTUuNTY0LDgwLjk3MnM4MC45NzIsMTIxLjg2Niw4MC45NzIsMTk1LjU2NFM1NTMuODg3LDQ0OS42ODYsNTAxLjc4Nyw1MDEuNzg3eiBNMzk5LjIxOCwyMzQuODk5bC03NC41MTUsNzQuNTE1ICAgbDc0LjUxNSw3NC41MTVjNS42NDEsNS42NDEsNS42NDEsMTUuMjE1LDAsMjAuODU1Yy0zLjE5MSwzLjE5MS02LjM4Myw0LjAwOC0xMC4zOTEsNC4wMDhjLTQuMDA4LDAtNy4xOTktMS42MzMtMTAuMzktNC4wMDggICBsLTc0LjU4OS03NC41MTVsLTc0LjU4OSw3NC41MTVjLTMuMTkxLDMuMTkxLTYuMzgzLDQuMDA4LTEwLjM5LDQuMDA4cy03LjE5OS0xLjYzMy0xMC4zOS00LjAwOCAgIGMtNS42NDEtNS42NDEtNS42NDEtMTUuMjE1LDAtMjAuODU1bDc0LjUxNS03NC41MTVsLTc0LjUxNS03NC41MTVjLTUuNjQxLTUuNjQxLTUuNjQxLTE1LjIxNSwwLTIwLjg1NSAgIGM1LjY0MS01LjY0MSwxNS4yMTUtNS42NDEsMjAuODU1LDBsNzQuNTE1LDc0LjUxNWw3NC41MTUtNzQuNTE1YzUuNjQxLTUuNjQxLDE1LjIxNS01LjY0MSwyMC44NTUsMCAgIEM0MDQuODU4LDIxOS42ODUsNDA0Ljg1OCwyMjguNDQyLDM5OS4yMTgsMjM0Ljg5OXoiIGZpbGw9IiNmNTVhNGUiLz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8L3N2Zz4K);
  background-size: 20px 20px;
  background-repeat: no-repeat;
  background-position: center;
}

.i-left {
  background-image: url(data:image/svg+xml;utf8;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pgo8IS0tIEdlbmVyYXRvcjogQWRvYmUgSWxsdXN0cmF0b3IgMTYuMC4wLCBTVkcgRXhwb3J0IFBsdWctSW4gLiBTVkcgVmVyc2lvbjogNi4wMCBCdWlsZCAwKSAgLS0+CjwhRE9DVFlQRSBzdmcgUFVCTElDICItLy9XM0MvL0RURCBTVkcgMS4xLy9FTiIgImh0dHA6Ly93d3cudzMub3JnL0dyYXBoaWNzL1NWRy8xLjEvRFREL3N2ZzExLmR0ZCI+CjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayIgdmVyc2lvbj0iMS4xIiBpZD0iQ2FwYV8xIiB4PSIwcHgiIHk9IjBweCIgd2lkdGg9IjY0cHgiIGhlaWdodD0iNjRweCIgdmlld0JveD0iMCAwIDQxNC4yOTggNDE0LjI5OSIgc3R5bGU9ImVuYWJsZS1iYWNrZ3JvdW5kOm5ldyAwIDAgNDE0LjI5OCA0MTQuMjk5OyIgeG1sOnNwYWNlPSJwcmVzZXJ2ZSI+CjxnPgoJPHBhdGggZD0iTTMuNjYzLDQxMC42MzdjMi40NDEsMi40NCw1LjY0LDMuNjYxLDguODM5LDMuNjYxYzMuMTk5LDAsNi4zOTgtMS4yMjEsOC44MzktMy42NjFsMTg1LjgwOS0xODUuODFsMTg1LjgxLDE4NS44MTEgICBjMi40NCwyLjQ0LDUuNjQxLDMuNjYxLDguODQsMy42NjFjMy4xOTgsMCw2LjM5Ny0xLjIyMSw4LjgzOS0zLjY2MWM0Ljg4MS00Ljg4MSw0Ljg4MS0xMi43OTYsMC0xNy42NzlsLTE4NS44MTEtMTg1LjgxICAgbDE4NS44MTEtMTg1LjgxYzQuODgxLTQuODgyLDQuODgxLTEyLjc5NiwwLTE3LjY3OGMtNC44ODItNC44ODItMTIuNzk2LTQuODgyLTE3LjY3OSwwbC0xODUuODEsMTg1LjgxTDIxLjM0LDMuNjYzICAgYy00Ljg4Mi00Ljg4Mi0xMi43OTYtNC44ODItMTcuNjc4LDBjLTQuODgyLDQuODgxLTQuODgyLDEyLjc5NiwwLDE3LjY3OGwxODUuODEsMTg1LjgwOUwzLjY2MywzOTIuOTU5ICAgQy0xLjIxOSwzOTcuODQxLTEuMjE5LDQwNS43NTYsMy42NjMsNDEwLjYzN3oiIGZpbGw9IiM4NzMxNGUiLz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8L3N2Zz4K);
  background-size: 16px 16px;
  background-repeat: no-repeat;
  background-position: center;
}

/*--------------------
Login Box
---------------------*/

.box {
  width: 330px;
  position: absolute;
  top: 50%;
  left: 50%;
  
  -webkit-transform: translate(-50%, -50%);
          transform: translate(-50%, -50%);
}

.box-form {
  width: 320px;
  position: relative;
  z-index: 1;
}

.box-login-tab {
	width: 100%;
  height: 50px;
  background:linear-gradient( 90deg, rgb(56 54 54) 0%, rgb(27 131 173) 100%);
  color:inherit; text-align:center;
  color: #FFFFFF !important;
	position: relative;
	float: left;
	z-index: 1;
  

  
	-webkit-transform: perspective(0px) rotateX(0.93deg) translateZ(-1px);
	        transform: perspective(0px) rotateX(0.93deg) translateZ(-1px);
	-webkit-transform-origin: 0 0;
	        transform-origin: 0 0;
	-webkit-backface-visibility: hidden;
	        backface-visibility: hidden;
	
	-webkit-box-shadow: 15px -15px 30px rgba(0,0,0,0.32);
     -moz-box-shadow: 15px -15px 30px rgba(0,0,0,0.32);
          box-shadow: 15px -15px 30px rgba(0,0,0,0.32);
}

.box-login-title {
	width: 80%;
	min-height: 250px;
    font-weight:bold;
	position: absolute;
	float: left;
	z-index: 2;
}

.box-login {
  position: relative;
    top: 10px;
    min-width: 400px;
    background: #fff;
    text-align: center;
    overflow: hidden;
    z-index: 2;
    min-height: 420px;

}



.line-wh {
 	width: 100%;
  height: 1px;
  top: 0px;
  margin: 12px auto;
	position: relative;
	border-top: 1px solid rgba(255,255,255,0.3);
}

/*--------------------
Form
---------------------*/

a { text-decoration: none; }

button:focus { outline:0; }

.b {
	height: 24px;
	line-height: 24px;
	background-color: transparent;
  border: none;
  cursor: pointer;
}

.b-form {
	opacity: 0.5;
	margin: 10px 20px;
  float: right;
}

.b-info {
  opacity: 0.5;
  float: left;
}

.b-form:hover, 
.b-info:hover {
  opacity: 1;
}

.b-support, .b-cta {
	width: 100%;
	padding: 0px 15px;
  font-family: 'Quicksand', sans-serif;
  font-weight: 700;
  letter-spacing: -1px;
  font-size: 16px;
  line-height: 32px;
  cursor: pointer;
    
  -webkit-border-radius: 16px;
     -moz-border-radius: 16px;
          border-radius: 16px;
}

.b-support {
  border: #87314e 1px solid;
  background-color: transparent;
  color: #87314e;
  margin: 6px 0;
}

.b-cta {
  border: #df405a 1px solid;
  background-color: #df405a;
  color: #fff;
}

.b-support:hover, .b-cta:hover {
  color: #fff;
	background-color: #87314e;
	border: #87314e 1px solid;
}

.fieldset-body {
    display: table;
}

.fieldset-body p {
    width: 100%;
    display: inline-table;
    padding: 5px 20px;
    margin-bottom:2px;
}

label {
	float: left;
  width: 100%;
	top: 0px;
	color: #032942;
	font-size: 12px;
	font-weight: 700;
	text-align: left;
	line-height: 2.0;
}

label.checkbox {
	float: left;
  padding: 5px 20px;
	line-height: 1.7;
}

input[type=text],
input[type=password] {
    width: 100%;
    height: 32px;
    padding: 0px 10px;
    background-color: rgba(0,0,0,0.03);
    border: none;
    display: inline;
    color: #303030;
    font-size: 16px;
    font-weight: 400;
    float: left;
    
    -webkit-box-shadow: inset 1px 1px 0px rgba(0,0,0,0.05), 1px 1px 0px rgba(255,255,255,1);
    -moz-box-shadow: inset 1px 1px 0px rgba(0,0,0,0.05), 1px 1px 0px rgba(255,255,255,1);
    box-shadow: inset 1px 1px 0px rgba(0,0,0,0.05), 1px 1px 0px rgba(255,255,255,1);
}

input[type=text]:focus,
input[type=password]:focus {
    background-color: #f8f8c6;
    outline: none;
}

input[type=submit]  {
  width: 50%;
  height: 48px;
  margin-top: 24px;
  padding: 0px 20px;
  font-family: 'sans-serif';
  border-radius:4px;
	font-weight: 700;
	font-size: 18px;
	color: #fff;
  line-height: 40px;
  text-align: center;
  background-color: #006cb5;
  border: 1px #006cb5 solid;
	opacity: 1;
	cursor: pointer;
}

input[type=submit]:hover {
	background-color: #767070;
  border: 1px #f8f8c6 solid;
  color:#fff;
}

input[type=submit]:focus {
	outline: none;
}

p.field span.i {
	width: 24px;
  height: 24px;
  float: right;
  position: relative;
  margin-top: -26px;
  right: 2px;
  z-index: 2;
  display: none;
            
  -webkit-animation: bounceIn 0.6s linear;
     -moz-animation: bounceIn 0.6s linear;
  	   -o-animation: bounceIn 0.6s linear;
          animation: bounceIn 0.6s linear;
}

/*--------------------
Transitions
---------------------*/

.box-form, .box-info, .b, .b-support, .b-cta,
input[type=submit], p.field span.i {
    
	-webkit-transition: all 0.3s;
     -moz-transition: all 0.3s;
      -ms-transition: all 0.3s;
       -o-transition: all 0.3s;
          transition: all 0.3s;
}

/*--------------------
Credits
---------------------*/



.icon-credits {
  width: 100%;
  position: absolute;
  bottom: 4px;
  font-family:'Helvetica Neue', Helvetica, sans-serif;
  font-size: 12px;
  color: rgba(255,255,255,0.1);
  text-align: center;
  z-index: -1;
}

.icon-credits a {
  text-decoration: none;
  color: rgba(255,255,255,0.2);
}
</style>
<script>
$(document).ready(function() {
    $("#do_login").click(function() { 
       closeLoginInfo();
       $(this).parent().find('span').css("display","none");
       $(this).parent().find('span').removeClass("i-save");
       $(this).parent().find('span').removeClass("i-warning");
       $(this).parent().find('span').removeClass("i-close");
       
        var proceed = true;
        $("#login_form input").each(function(){
            
            if(!$.trim($(this).val())){
                $(this).parent().find('span').addClass("i-warning");
            	$(this).parent().find('span').css("display","block");  
                proceed = false;
            }
        });
       
        if(proceed) //everything looks good! proceed...
        {
            $(this).parent().find('span').addClass("i-save");
            $(this).parent().find('span').css("display","block");
        }
    });
    
    //reset previously results and hide all message on .keyup()
    $("#login_form input").keyup(function() { 
        $(this).parent().find('span').css("display","none");
    });
 
  openLoginInfo();
  setTimeout(closeLoginInfo, 1000);
});

function openLoginInfo() {
    $(document).ready(function(){ 
    	$('.b-form').css("opacity","0.01");
      $('.box-form').css("left","-37%");
      $('.box-info').css("right","-37%");
    });
}

function closeLoginInfo() {
    $(document).ready(function(){ 
    	$('.b-form').css("opacity","1");
    	$('.box-form').css("left","0px");
      $('.box-info').css("right","-5px"); 
    });
}

$(window).on('resize', function(){
      closeLoginInfo();
});
</script>

</head>
<body class="">

<div class='box'>
  <div class='box-form'>
    <div class=''>
 
    </div>

  
     
      
    </div>
    
    <div class='box-login'>
   
    <h2 style="margin: 0 auto !imporntant; color:#000;">iHRIS MOBILE UPDATE TOOL</h2>
     <img src="<?php echo base_url(); ?>assets/img/MOH.png" width="120" height="120">
    <p style="color:blue;"><?php echo $this->session->flashdata('msg'); ?></p>
      <form class='fieldset-body' id='login_form' role="form" method="post" action="<?php echo base_url(); ?>auth/login">
        
        <p class='field'>
       
          <label for='username'>USERNAME</label>
          <input type='text'  name='username' title='Username' required>
        </p>
      	  <p class='field'>
          <label for='passsord'>PASSWORD</label>
          <input type='password'  name='password' title='Password' required>
          </p>

       

        	<input type='submit'  value='Login' title='Login' />
      </form>
    </div>
  </div>
 
</div>
<div class='icon-credits'> <a href="http://health.go.ug" title="MOH" target="_blank">Ministry of Health <?php echo date('Y');?></a></div>
</footer>
<footer style="margin-top:100px;" class="icon-credits">

  <div class="col-md-4">
   <img src="data:image/png;base64,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" style="width:150px; height:45px; border-radius:4px;">
               
  </div>
  <div class="col-md-4">
   <img src="https://www.ihris.org/sites/ihris/files/ihrislogo2019a.png" style="width:150px; height:45px; border-radius:4px; ">
               
  </div>
  <div class="col-md-4">
   <img src="https://www.pmlive.com/__data/assets/image/0011/1329842/who.jpg" style="width:150px; height:45px; border-radius:4px;">
               
  </div>




  
</body>

</html>
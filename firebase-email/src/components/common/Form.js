import * as React from "react";
import { useEffect } from "react";
import Box from "@mui/material/Box";
import TextField from "@mui/material/TextField";
//import Button from "./Button";
import {
  Button,
  Grid,
  useTheme,
  Paper,
  useMediaQuery,
  Stack,
  Container,
} from "@mui/material";
import "./Form.css";
import Background from "../img/mylogin.jpg";
import { ReactComponent as Logo } from "../img/grapiku.svg";
import { createTheme, ThemeProvider } from "@mui/material/styles";
import {
  FormContainer,
  TextFieldElement,
  PasswordElement,
} from "react-hook-form-mui";
import FieldError from "react-hook-form";
const theme = createTheme({
  palette: {
    primary: {
      main: "#9f1d35",
      darker: "#730e20",
    },
  },
});

export default function BasicTextFields({
  title,
  setPassword,
  setEmail,
  handleAction,
}) {
  // useEffect(() => {
  //   const keyDownHandler = (event) => {
  //     if (event.key === "Enter") {
  //       event.preventDefault();
  //       handleAction(handleAction);
  //     }
  //   };
  //   document.addEventListener("keydown", keyDownHandler);

  //   return () => {
  //     document.removeEventListener("keydown", keyDownHandler);
  //   };
  // }, []);

  // const form = () => {
  //   const form = {
  //     agree: false,
  //   };
  //   return (
  //     <FormContainer
  //       defaultValues={form}
  //       //onSuccess={action("submit")}
  //       FormProps={{
  //         "aria-autocomplete": "none",
  //         autoComplete: "new-password",
  //       }}
  //     >
  //       <TextFieldElement
  //         required
  //         autoComplete={"new-password"}
  //         margin={"dense"}
  //         label={"Name"}
  //         name={"default-text-field"}
  //       />
  //       <br />
  //       <TextFieldElement
  //         required
  //         type={"email"}
  //         margin={"dense"}
  //         label={"Email"}
  //         name={"default-email-field"}
  //       />
  //       <br />
  //       <TextFieldElement
  //         required
  //         //parseError={parseError}
  //         type={"email"}
  //         margin={"dense"}
  //         label={"Email with ParseError"}
  //         name={"default-email-field-with-parsed"}
  //       />
  //       <br />
  //       <TextFieldElement
  //         margin={"dense"}
  //         label={"Number"}
  //         name={"number-text-field"}
  //         required
  //         type={"number"}
  //       />
  //       <br />
  //       <Button type={"submit"} color={"primary"} variant={"contained"}>
  //         Submit
  //       </Button>
  //     </FormContainer>
  //   );
  // };
  const parseError = (FieldError) => {
    if (FieldError.type === "pattern") {
      return "Periksa Email Anda";
    }
    return "Silahkan isi Kolom ini";
  };
  const form = {
    agree: false,
  };
  return (
    <ThemeProvider theme={theme}>
      <Grid
        container
        sx={{
          width: "100%",
          minHeight: "100vh",
          background: `url(${Background})`,
          backgroundRepeat: "no-repeat",
          backgroundSize: "cover",
        }}
        alignItems="center"
        justifyContent="center"
      >
        <Grid item xl={3} xs={5}>
          <Box
            autoComplete="on"
            sx={{
              "& .MuiTextField-root": { m: 1, width: "95%" },
              "& .MuiButton-root": { m: 1, width: "95%" },
              backgroundColor: "white",
              p: 2,
              borderRadius: "20px",
            }}
          >
            <Logo width="50%" />
            <h3>{title} Form</h3>

            <FormContainer
              defaultValues={form}
              onSuccess={handleAction}
              FormProps={{
                "aria-autocomplete": "none",
                autoComplete: "new-password",
              }}
            >
              <TextFieldElement
                required
                autoComplete={"new-password"}
                parseError={parseError}
                type={"email"}
                label={"Masukkan Email"}
                name={"email"}
                id={"email"}
                variant="outlined"
                onChange={(e) => setEmail(e.target.value)}
              />
              <PasswordElement
                required
                label={"Masukkan Password"}
                parseError={parseError}
                name={"password"}
                id={"password"}
                variant="outlined"
                onChange={(e) => setPassword(e.target.value)}
              />
              <Button type={"submit"} color={"primary"} variant={"contained"}>
                Login
              </Button>
            </FormContainer>
            {/* <TextField
              type="email"
              id="email"
              label="Masukkan Email"
              variant="outlined"
              onChange={(e) => setEmail(e.target.value)}
            />
            <TextField
              type="password"
              id="password"
              label="Masukkan Password"
              variant="outlined"
              onChange={(e) => setPassword(e.target.value)}
            />
            <Button title={title} handleAction={handleAction} /> */}
          </Box>
        </Grid>
      </Grid>
    </ThemeProvider>
    // <Box
    //   component="form"
    //   autoComplete="on"
    //   sx={{
    //     "& .MuiTextField-root": { m: 1, width: "100%" },
    //     "& .MuiButton-root": { m: 1, width: "100%" },
    //   }}
    // >
    //   <h3>{title} Form</h3>
    //   <TextField
    //     type="email"
    //     id="email"
    //     multiline
    //     label="Masukkan Email"
    //     variant="outlined"
    //     onChange={(e) => setEmail(e.target.value)}
    //   />
    //   <TextField
    //     type="password"
    //     id="password"
    //     multiline
    //     label="Masukkan Password"
    //     variant="outlined"
    //     onChange={(e) => setPassword(e.target.value)}
    //   />
    //   <Button multiline title={title} handleAction={handleAction} />
    // </Box>

    // <div style={{ width: "100%", height: "100vh", backgroundColor: "green" }}>
    //   <Box component="form" autoComplete="on">
    //     <h3>{title} Form</h3>
    //     <TextField
    //       type="email"
    //       id="email"
    //       label="Masukkan Email"
    //       variant="outlined"
    //       onChange={(e) => setEmail(e.target.value)}
    //     />
    //     <TextField
    //       type="password"
    //       id="password"
    //       label="Masukkan Password"
    //       variant="outlined"
    //       onChange={(e) => setPassword(e.target.value)}
    //     />
    //   <Button title={title} handleAction={handleAction} />
    //   </Box>
    // </div>
  );
}

import * as React from "react";
import Button from "@mui/material/Button";
import { styled } from "@mui/material/styles";

const ColorButton = styled(Button)(({ theme }) => ({
  backgroundColor: "#9f1d35",
  "&:hover": {
    backgroundColor: "#730e20",
  },
  padding: "20",
  fontSize: "16px",
}));

export default function BasicButtons({ title, handleAction }) {
  return (
    <ColorButton variant="contained" onClick={handleAction}>
      {title}
    </ColorButton>
  );
}

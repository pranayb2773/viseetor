import "./bootstrap";

import dayjs from "dayjs/esm";
import customParseFormat from "dayjs/plugin/customParseFormat";
import Choices from "choices.js/public/assets/scripts/choices";

dayjs.extend(customParseFormat);
window.dayjs = dayjs;
window.Choices = Choices;

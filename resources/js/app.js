import "./bootstrap";

import dayjs from "dayjs/esm";
import customParseFormat from "dayjs/plugin/customParseFormat";

dayjs.extend(customParseFormat);

window.dayjs = dayjs;

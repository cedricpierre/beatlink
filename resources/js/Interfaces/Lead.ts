import {ILink} from "@/Interfaces/Link";

export interface ILead {
    id: string
    country: string
    user_agent: string
    ip: string
    link: ILink
    country_code: string
    referrer: string
    email: string
    name: string
    phone: string
}

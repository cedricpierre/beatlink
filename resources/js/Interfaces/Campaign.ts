import {ILink} from "@/Interfaces/Link";

export interface ICampaign {
    id: string
    name: string
    slug: string
    description: string
    settings: object
    created_at: Date
    updated_at: Date
    is_dark: boolean
    views_count: number
    leads_count: number
    links_count: number
    conversion_rate: number
    links: Array<ILink>
    image_url: string
    background_url: string
}

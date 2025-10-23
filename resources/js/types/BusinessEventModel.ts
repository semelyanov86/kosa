import { ContactModel } from '@/types/ContactModel';

export interface BusinessEventModel {
    id: number;
    name: string;
    place: string;
    started_at: string;
    ended_at: string;
    contacts: ContactModel[];
}

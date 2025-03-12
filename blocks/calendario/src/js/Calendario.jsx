import React from 'react';
import StudyTimeView from './pages/StudyTimeView';
import CalendarNavigation from './components/CalendarNavigation';
import { useLocalStorageCalendario } from './functions/useLocalStorage';

const Calendario = ({ data: studyTimes }) => {
  const [studyTime, setStudyTime] = useLocalStorageCalendario('study_time', null);
  if (!studyTimes) {
    return null;
  }
	if (studyTime !== null && studyTime !== '') {
  	return (
			<StudyTimeView
        title={studyTimes[studyTime].label}
        months={studyTimes[studyTime].months}
				setStudyTime={setStudyTime}
			/>
		);
	}
	return (
		<div className="cb__container">
  <CalendarNavigation title="Calendario de estudios" />
  <div className="cb__card">
    <h2 className="title">¿En cuánto tiempo quieres finalizar tu curso?</h2>
    <article className="cb__study-times">
      {studyTimes.map((studyTime, index) => {
          return (
            <button
              disabled={!studyTime.disabled ? true : false}
              key={index}
              onClick={() => setStudyTime(index)}
              className={`${!studyTime.disabled ? 'card-button disabled' : 'card-button' }`}
            >
              <span>{studyTime.label}</span>
              <p>{!studyTime.disabled && `${studyTime?.disabled_message}`}</p>
            </button>
          );
      })}
    </article>
  </div>
</div>
	);
};

export default Calendario;
